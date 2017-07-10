<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 5:36 AM
 */

namespace Module\Cms\Src\Model;

use Lib\Database\Proxy;
use Module\Cms\Src\Model\Interfaces\ContentInterface;

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

    //根据menu_id查询栏目信息
    public function get_menu_info($menu_id)
    {
        $sql = 'select m.id,m.name,m.category_tpl,m.list_tpl,m.detail_tpl,mo.module_type from menu as m LEFT JOIN modules as mo on mo.id = m.module_id where m.id = :id';
        return self::exec($sql,[
            ':id'=>$menu_id
        ]);
    }


}