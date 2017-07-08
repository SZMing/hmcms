<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-16
 * Time: 下午3:29
 */

class Module
{
    static public function controller_config()
    {
        return [
            'UserController' => [

            ],

            'IndexController' => [

            ],

            'NewsController' => [
                \Module\Web\Src\Model\NewsModel::getInstance(),
            ],

            'ApplyController' => [
                \Module\Web\Src\Model\ApplyModel::getInstance(),
            ],

            'ChatController' => [
                \Module\Web\Src\Model\ChatModel::getInstance(),
            ],
        ];
    }
}