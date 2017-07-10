<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-15
 * Time: 上午11:27
 */

return [
    'cache' => false,
    //启用的模板
    'theme' => 'wghome',
    'tags' => [
        'tag_comment'  => array('<%#', '%>'),
        'tag_block'    => array('<%', '%>'),
        'tag_variable' => array('<%=', '%>'),
    ],
];