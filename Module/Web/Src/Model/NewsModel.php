<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/30/17
 * Time: 8:45 AM
 */

namespace Module\Web\Src\Model;

use Lib\Database\Proxy;
use Module\Web\Src\Model\Interfaces\NewsInterface;

class NewsModel extends Proxy implements NewsInterface
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
     * 获取新闻列表
     * m_id (1为玩购动态，2为媒体报道)
     */
    static public function news($offset = 1,$many = 10,$m_id = 1)
    {
        //获取新闻总条数
        $sql = 'select count(*) as count from pc_article where m_id = :m_id';
        $count = self::get_one(self::exec($sql,[':m_id'=>$m_id]));


        $limit = ' limit '.($offset-1).','.$many;
        $sql = 'select title,descrip,create_time from pc_article '.$limit;
        $result = self::exec($sql);

        return ['count' => $count,'result' => $result];
    }
}