<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 9:11 AM
 */

namespace Module\Admin\Src\Model;

use Lib\Database\Proxy;
use Module\Admin\Src\Model\Interfaces\MenuInterface;

class MenuModel extends Proxy implements MenuInterface
{
    //静态变量保存全局实例
    private static $_instance = null;

    //私有构造函数，防止外界实例化对象

    //私有克隆函数，防止外办克隆对象
    private function __clone()
    {
    }

    //静态方法，单例统一访问入口
    static public function getInstance()
    {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 菜单列表
     */
    public function menu_lists($page_index,$page_size,$name)
    {
        $spage = (($page_index-1)*$page_size);
        //判断是否有关键词
        if($name)
        {
            $like = '%'.$name.'%';
            $sql = "select id,name,module_id,descrip,status from menu where name like '".$like."' limit $spage,$page_size";
            //查询总条数
            $sql_count = "select count(*) as counts from menu where name like '".$like."'";
        }else
        {
            $sql = "select id,name,module_id,descrip,status from menu limit $spage,$page_size";
            //查询总条数
            $sql_count = 'select count(*) as counts from menu';
        }

        $result = self::exec($sql);
        $counts = self::exec($sql_count);
        return ['result' => $result,'counts'=>(int)$counts[0]['counts']];
    }

    /**
     * 添加栏目
     */
    public function add_menu($data)
    {
        $sql = 'insert into menu(id,pid,name,module_id,status,descrip) values(:id,:pid,:name,:module_id,:status,:descrip)';
        return self::exec($sql,[
            ':id' => null,
            ':pid' => $data['pid'],
            ':status' => $data['status'],
            ':name' => $data['name'],
            ':module_id' => $data['module_id'],
            ':descrip' => $data['descrip']
        ]);
    }

    /**
     * 查询模型
     */
    public function get_modules()
    {
        $sql = 'select id,name from modules where status = 1';
        return self::exec($sql);
    }

    /**
     * 查询菜单
     */
    public function get_menus()
    {
        $sql = 'select m1.id as m1id,m1.name as m1name,m2.id as m2id,m2.name as m2name from menu as m1 left join menu as m2 on m2.pid = m1.id where m1.pid = 0';
        
        return self::exec($sql);
    }

}