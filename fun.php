<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 2:57 AM
 */

$database_info = [

        'host' => '118.190.104.201',
        'port' => '3306',
        'db' => 'sst',
        'user' => 'sst',
        'pwd' => 'A0a2fe9a3cbe5474',
        'charset' => 'utf8'
    ];


$pdo = new \PDO('mysql:host='.$database_info['host'].';dbname='.$database_info['db'].';charset='.$database_info['charset'], $database_info['user'], $database_info['pwd']);

$pdo->beginTransaction();
try{

    //1.获取yht_order_game中的记录（条件：pay_status=1,callback_status=1,is_rebate=0;
    $sql1 = 'select user_id,amount from yht_order_game where pay_status = 1 and callback_status = 1 and is_rebate = 0';
    $handle1 = $pdo->prepare($sql1);
    $handle1->execute([]);
    $result1 = $handle1->fetchAll(\PDO::FETCH_ASSOC);

    print_r($result1);

    $str = '(';
    $i = 0;
    foreach ($result1 as $v)
    {
        if($i < (count($result1)-1))
        {
            $str .= "'".$v['user_id']."'".',';
        }else
        {
            $str .= "'".$v['user_id']."'";
        }
        $i++;
    }
    $str .= ')';

    //2.获取yht_user_info中的first_channel_id和second_channel_id（条件：user_id);//3.获取yht_rebate_channel_config的省级返点配置（条件：first_channel_id）；
    $sql2 = 'select * from yht_user_info JOIN yht_rebate_channel_config on yht_user_info.first_channel_id = yht_rebate_channel_config.channel_id where user_id in '.$str;
    $handle2 = $pdo->prepare($sql2);
    $handle2->execute([]);
    $result2 = $handle2->fetchAll(\PDO::FETCH_ASSOC);

    print_r($result2);


    //4.获取yht_rebate_channel_config的市返点配置（条件：second_channel_id）；
    $sql3 = 'select * from yht_user_info JOIN yht_rebate_channel_config on yht_user_info.second_channel_id = yht_rebate_channel_config.channel_id where user_id in '.$str;
    $handle3 = $pdo->prepare($sql3);
    $handle3->execute([]);
    $result3 = $handle3->fetchAll(\PDO::FETCH_ASSOC);

    print_r($result3);

    //5.获取yht_rebate_agent_config的代理返点配置（条件：second_channel_id）；
    $sql4 = 'select * from yht_user_info JOIN yht_rebate_agent_config on yht_user_info.second_channel_id = yht_rebate_agent_config.channel_id where user_id in '.$str;
    $handle4 = $pdo->prepare($sql4);
    $handle4->execute([]);
    $result4 = $handle4->fetchAll(\PDO::FETCH_ASSOC);

    print_r($result4);

    //6.获取yht_user_info的上级代理用户referee_uid；第二步已经查询

    //7.根据省级返点配置计算省级返点（更新yht_channel表的total_money字段，yht_channel_fund_record添加记录）；
    $slug = 1;




    //8.根据市级返点配置计算市级返点（更新yht_channel表的total_money字段，yht_channel_fund_record添加记录）；

    //9.根据代理返点配置计算代理返点（更新yht_user_info表的total_money字段，yht_user_order_rebate_record）；

    //10.更新yht_order_game的is_rebate=1；

}catch (\Exception $exception)
{
    $pdo->rollBack();
    var_dump($exception);
}