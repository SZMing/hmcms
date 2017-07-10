<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 5:20 AM
 */

namespace Module\Cms\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Cms\Src\Model\Interfaces\ContentInterface;

class ContentController extends Controller
{
    public function __construct(ContentInterface $content)
    {
        $this->content_model = $content;
        $this->request = new Request();
    }

    public function test()
    {
        return 'this is content test';
    }

    /**
     * content 中转方法
     */
    public function content()
    {

    }

    /**
     * lists 方法
     */
    public function lists()
    {
        $data = $this->request->all();
        //接受栏目的id
        $menu_id = $data['menu_id'];
        //根据menu_id查询出二级模板（暂时用不到）,列表页，内容页
        $info = $this->content_model->get_menu_info($menu_id);

        var_dump($info);
    }


    /**
     * detail 方法
     */
    public function detail()
    {

    }


}