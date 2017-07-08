<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午2:17
 */
namespace Module\Application\Src\Model;

use Lib\Model;
use Module\Application\Src\Model\Interfaces\UserInterface;

class UserModel extends Model implements UserInterface
{

    //静态变量保存全局实例
    private static $_instance = null;

    //私有构造函数，防止外界实例化对象
    protected function __construct()
    {
        $dbh = new \PDO('mysql:host=127.0.0.1;dbname=wg', 'root', 'pass4mingming');
        parent::__construct($dbh);
    }

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