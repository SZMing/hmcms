<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 1:09 AM
 */

namespace Module\Admin\Src\Model;

use Lib\Database\Proxy;
use Module\Admin\Src\Model\Interfaces\ModuleInterface;

class ModuleModel extends Proxy implements ModuleInterface
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
     *
     * 新增模型
     */
    public function add_module($data)
    {
        $sql = 'insert into modules(id,status,name,module_type,descrip) values(:id,:status,:name,:module_type,:descrip)';
        return self::exec($sql,[
            ':id' => null,
            ':status' => $data['status'],
            ':name' => $data['name'],
            ':module_type' => $data['module_type'],
            ':descrip' => $data['descrip']
        ]);
    }

    /**
     * 模型列表
     */
    public function module_lists($page_index,$page_size,$name)
    {
        $spage = (($page_index-1)*$page_size);
        //判断是否有关键词
        if($name)
        {
            $like = '%'.$name.'%';
            $sql = "select id,status,name,module_type,descrip from modules where name like '".$like."' limit $spage,$page_size";
            //查询总条数
            $sql_count = "select count(*) as counts from modules where name like '".$like."'";
        }else
        {
            $sql = "select id,status,name,module_type,descrip from modules limit $spage,$page_size";
            //查询总条数
            $sql_count = 'select count(*) as counts from modules';
        }

        $result = self::exec($sql);
        $counts = self::exec($sql_count);
        return ['result' => $result,'counts'=>(int)$counts[0]['counts']];
    }

    /**
     * 删除模型
     */
    public function delete_module($module_id)
    {
        $sql = 'delete from modules where id = :id';
        return self::exec($sql,[
            ':id' => $module_id
        ]);
    }
}