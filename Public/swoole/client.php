<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/5/17
 * Time: 5:51 AM
 */

$client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC); //异步非阻塞
$client->on("connect", function($cli) {
    echo 'I am connecting...';
    $cli->send("hello world\n");
});

$client->on("receive", function($cli, $data = ""){
    $data = $cli->recv(); //1.6.10+ 不需要
    if(empty($data)){
        $cli->close();
        echo "closed\n";
    } else {
        echo "received: $data\n";
        sleep(1);
        $cli->send("hello\n");
    }
});

$client->on("close", function($cli){
    $cli->close(); // 1.6.10+ 不需要
    echo "close\n";
});

$client->on("error", function($cli){
    exit("error\n");
});

$client->connect('127.0.0.1', 9501, 0.5);