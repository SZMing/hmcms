<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-16
 * Time: 下午1:55
 */

namespace Lib\Database;

use Lib\Factories\Factory;

class Proxy
{
    protected $dbh;

    //链接数据库
    public function __construct()
    {
        $this->dbh = Factory::getDatabase('master');
    }

    public function exec($sql,$arr = [])
    {
        if(strtolower(substr($sql,0,6)) === 'select')
        {
            $link = Factory::getDatabase('slaver');
            $p = $link->prepare($sql);
            $p->execute($arr);
            return $p->fetchAll(\PDO::FETCH_ASSOC);
        }else
        {
            //$link = Factory::getDatabase('master');
            $p = $this->dbh->prepare($sql);
            $p->execute($arr);

            return $p->rowCount();
        }
    }

    public function get_one($result)
    {
        return $result[0];
    }


    /**
     * 获取上一次插入操作的id
     */
    protected function get_insert_id()
    {
        return (int)$this->dbh->lastInsertId();
    }

    /**
     * 获取sql的结果记录总数
     * 增删改查
     */
    protected function count($sql)
    {
        $result = $this->dbh->query($sql);
        return $result->rowCount();
    }

    /**
     * 开启事物
     */
    protected function start_trans()
    {
        $this->dbh->beginTransaction();
    }

    /**
     * 提交事物
     */
    protected function commit()
    {
        $this->dbh->commit();
    }

    /**
     * 回滚事物
     */
    protected function rollback()
    {
        $this->dbh->rollBack();
    }
}