<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 5:13 AM
 */

class Module
{
    static public function controller_config()
    {
        return [
            'ContentController' => [
                \Module\Cms\Src\Model\ContentModel::getInstance(),
            ],
        ];
    }
}