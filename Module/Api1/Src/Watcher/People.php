<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-15
 * Time: 上午10:55
 */

namespace Module\Api1\Src\Watcher;

use Lib\Event\Observer;

class People implements Observer
{
    public function watch()
    {
        echo 'This is the people watcher';
    }
}

