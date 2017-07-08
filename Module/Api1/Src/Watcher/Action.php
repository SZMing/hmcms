<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-15
 * Time: 上午10:52
 */

namespace Module\Api1\Src\Watcher;

use Lib\Event\Observer;
use Lib\Event\Subject;

class Action implements Subject
{
    public $observers=array();

    public function register(Observer $observer)
    {
        $this->observers[] = $observer;
    }
    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->watch();
        }
    }
}