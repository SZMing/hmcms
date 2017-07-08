<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/5/17
 * Time: 2:05 AM
 */

namespace Module\Web\Src\Model;

use Lib\Database\Proxy;
use Module\Web\Src\Model\Interfaces\ChatInterface;

class ChatModel extends Proxy implements ChatInterface
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