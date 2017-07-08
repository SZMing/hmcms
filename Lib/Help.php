<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午1:28
 */

namespace Lib;

class Help
{
    /**
     * config
     */
    static public function config($param)
    {
        $arr = explode('.',$param);
        $data = require_once BASEPATH . '/../Config/'.$arr[0].'.php';
        return $data[$arr[1]];
    }
}