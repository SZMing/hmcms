<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午1:58
 */

class Module
{
    static public function controller_config()
    {
        return [
            'UserController' => [
                \Module\Application\Src\Model\UserModel::getInstance(),
                \Module\Application\Src\Model\ArticleModel::getInstance(),
            ],
        ];
    }
}