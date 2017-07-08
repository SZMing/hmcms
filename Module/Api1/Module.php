<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午3:23
 */

class Module
{
    static public function controller_config()
    {
        return [
            'UserController' => [
                \Module\Api1\Src\Model\UserModel::getInstance(),
            ]
        ];
    }
}