<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午2:37
 */

namespace Lib\Factories;

class ControllerFactory
{
    static public function make($class)
    {
        return new $class;
    }
}