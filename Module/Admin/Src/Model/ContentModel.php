<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 11:05 PM
 */

namespace Module\Admin\Src\Model;

use Lib\Database\Proxy;
use Module\Admin\Src\Model\Interfaces\ContentInterface;

class ContentModel extends Proxy implements ContentInterface
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
     * 取出栏目列表
     */
    public function get_menu_lists()
    {
        $sql = 'select m1.id as m1id,m1.name as m1name,m2.id as m2id,m2.name as m2name from menu as m1 left join menu as m2 on m2.pid = m1.id where m1.pid = 0';
        return self::exec($sql);
    }

    /**
     * 获取栏目内容
     */
    public function get_menu_content($menu_id)
    {
        $sql = 'select id,mid,title,author,status,descrip,content,create_time from content where mid = :mid limit 1';
        return self::get_one(self::exec($sql,[
            ':mid' => $menu_id,
        ]));
    }
}