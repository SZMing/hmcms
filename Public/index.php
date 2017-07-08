<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午12:01
 */

ini_set('display_errors','On');

define('BASEPATH',__DIR__);

//注册到php自动载入
spl_autoload_register(function($class){
    require BASEPATH .'/../'. str_replace('\\','/',$class).'.php';
});

use Lib\Route;
$route = new Route();
$route::boot();
