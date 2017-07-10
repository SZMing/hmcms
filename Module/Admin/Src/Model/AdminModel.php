<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 9:11 AM
 */

namespace Module\Admin\Src\Model;

use Lib\Database\Proxy;
use Module\Admin\Src\Model\Interfaces\AdminInterface;

class AdminModel extends Proxy implements AdminInterface
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

    //$page_index请求的页面，$page_size每页显示条数，$name搜索关键词
    static public function admin_lists($page_index,$page_size,$name)
    {
        $spage = (($page_index-1)*$page_size);
        //判断是否有关键词
        if($name)
        {
            $like = '%'.$name.'%';
            $sql = "select id,username,phonenum,from_unixtime(create_time) as create_time from admin where username like '".$like."' limit $spage,$page_size";
            //查询总条数
            $sql_count = "select count(*) as counts from admin where username like '".$like."'";


        }else
        {
            $sql = "select id,username,phonenum,from_unixtime(create_time) as create_time from admin limit $spage,$page_size";
            //查询总条数
            $sql_count = 'select count(*) as counts from admin';
        }

        $result = self::exec($sql);
        $counts = self::exec($sql_count);
        return ['result' => $result,'counts'=>(int)$counts[0]['counts']];
    }

}