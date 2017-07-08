<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-5-9
 * Time: 下午1:23
 */

namespace Lib;

class Request
{
    public function is_post()
    {
        if($_POST)
        {
            return true;
        }

        return false;
    }

    public function is_get()
    {
        if($_GET)
        {
            return true;
        }

        return false;
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function post($param = '')
    {
        if($param)
        {
            return $_POST[$param];
        }

        return $_POST;
    }

    public function get($param = '')
    {
        if($param)
        {
            return $_GET[$param];
        }

        return $_GET;
    }
}