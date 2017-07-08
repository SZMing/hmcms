<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午12:52
 */

namespace Lib;

class Route
{
    static public function boot()
    {
        $b = explode('/',$_SERVER['REQUEST_URI']);
        array_shift($b);

        //默认的方法
        if('' === $b[0])
        {
            $b[0] = 'web';
            $b[1] = 'index';
            $b[2] = 'index';
        }

        //var_dump($b);
        
        $c = '\\Module\\'.ucfirst($b[0]).'\\Src\\Controller\\'.ucfirst($b[1]).'Controller';
        //获取反射类实例
        $c = new \ReflectionClass($c);
        //获取注入到控制器中的（模型）参数
        require_once BASEPATH . '/../Module/'.ucfirst($b[0]).'/Module.php';
        $module = new \Module();
        $arr = $module::controller_config();
        $class = $c->newInstanceArgs($arr[ucfirst($b[1]).'Controller']);

        //截取 ？ 等
        $ac = explode('?',$b[2]);
        //$action = $b[2];
        //var_dump($ac);
        $action = $ac[0];
        //使用return
        call_user_func(function($result){
            exit($result);
        },$class->$action());
    }
}