<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-15
 * Time: 上午10:42
 */

namespace Lib\Event;

interface Subject
{
    public function register(Observer $observer);
    public function notify();
}