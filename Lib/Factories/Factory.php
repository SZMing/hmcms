<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-16
 * Time: 下午1:33
 */

namespace Lib\Factories;

use Lib\Database\Proxy;
use Lib\Help;

class Factory
{
    static public function getDatabase($id = 'proxy')
    {
        if($id == 'proxy')
        {
            if(!self::$proxy)
            {
                return self::$proxy = new Proxy();
            }

            return self::$proxy;
        }

        $help = new Help();

        //返回主库的连接对象
        if($id == 'master')
        {
            $database_info = $help::config('database.master');
            return new \PDO('mysql:host='.$database_info['host'].';dbname='.$database_info['db'].';charset='.$database_info['charset'], $database_info['user'], $database_info['pwd']);
            //return new \PDO('mysql:host=localhost;dbname=hmcms;charset=utf8', 'root', 'pass4mingming');
        }

        //返回从库的连接对象
        if($id == 'slaver')
        {
            $database_info = $help::config('database.slaver');

            return new \PDO('mysql:host='.$database_info['host'].';dbname='.$database_info['db'].';charset='.$database_info['charset'], $database_info['user'], $database_info['pwd']);
            //return new \PDO('mysql:host=localhost;dbname=hmcms;charset=utf8', 'root', 'pass4mingming');
        }
    }
}