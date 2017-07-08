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

}