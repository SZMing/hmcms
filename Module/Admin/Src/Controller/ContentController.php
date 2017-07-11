<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/10/17
 * Time: 11:03 PM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Admin\Src\Model\Interfaces\ContentInterface;

class ContentController extends Controller
{
    public function __construct(ContentInterface $content)
    {
        $this->content_model = $content;
        $this->request = new Request();
    }

    /**
     * 内容管理视图
     */
    public function content()
    {
        //获取栏目列表
        return $this->render('admin/content/content');
    }

    //获取栏目树
    public function get_menu_tree()
    {
        //查询菜单，发送到页面
        $data = $this->content_model->get_menu_lists();
        //整理菜单
        $menus = [];
        foreach ($data as $menu)
        {
            $menus[$menu['m1id']]['name'] = $menu['m1name'];
            $menus[$menu['m1id']]['id'] = $menu['m1id'];
            $menus[$menu['m1id']]['alias'] = 'ok';

            if($menu['m2id'])
            {
                $menus[$menu['m1id']]['children'][] = [
                    'id' => $menu['m2id'],
                    'alias' => 'okok',
                    'name' => $menu['m2name']
                ];
            }
        }
        return json_encode($menus);
    }

    //获取栏目内容
    public function get_menu_content()
    {
        $menu_id = $this->request->post('menu_id');
        $data = $this->content_model->get_menu_content($menu_id);
        return json_encode($data);
    }
}