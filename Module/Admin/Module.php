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
            'AdminController' => [
                \Module\Admin\Src\Model\AdminModel::getInstance(),
            ],

            'FrameController' => [

            ],

            'MenuController' => [
                \Module\Admin\Src\Model\MenuModel::getInstance(),
            ],

            'ModuleController' => [
                \Module\Admin\Src\Model\ModuleModel::getInstance(),
            ],

            'ContentController' => [
                \Module\Admin\Src\Model\ContentModel::getInstance(),
            ],
        ];
    }
}