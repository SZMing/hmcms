<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 9:36 AM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;
use Lib\Help;
use Lib\Request;
use Module\Admin\Src\Model\Interfaces\MenuInterface;

class MenuController extends Controller
{
    public function __construct(MenuInterface $menu)
    {
        $this->menu_model = $menu;
        $this->request = new Request();
    }

    /**
     * 栏目列表
     */
    public function menu()
    {
        return $this->render('admin/menu/menu_list');
    }

    /**
     * 栏目列表
     */
    public function menu_lists()
    {
        $page_index = $this->request->get('pageIndex');
        $page_size = $this->request->get('pageSize');

        $name = false;

        if($this->request->has('name'))
        {
            $name = $this->request->get('name');
        }

        $data = $this->menu_model->menu_lists($page_index,$page_size,$name);

        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => $data['result'],
            'count' => $data['counts'],
        ];

        return json_encode($data);
    }


    /**
     * 添加栏目
     */
    public function add_menu()
    {
        //查询模型，发送到页面
        $modules = $this->menu_model->get_modules();
        //查询菜单，发送到页面
        $data = $this->menu_model->get_menus();
        //整理菜单
        $menus = [];
        foreach ($data as $menu)
        {
            $menus[$menu['m1id']]['m1name'] = $menu['m1name'];
            $menus[$menu['m1id']]['m1id'] = $menu['m1id'];
            $menus[$menu['m1id']]['category'][] = [
                'm2id' => $menu['m2id'],
                'm2name' => $menu['m2name']
            ];
        }

        //查询模板
        //取出启用的模板
        $theme = Help::config('twig.theme');
        //取出所有的模板
        $tpls = Help::config('tpl.'.$theme);
        return $this->render('admin/menu/add_menu',['modules' => $modules,'menus'=>$menus,'tpls'=>$tpls]);
    }

    /**
     * ajax_add_menu
     */
    public function ajax_add_menu()
    {
        $name = $this->request->post('name');
        $pid = $this->request->post('pid');
        $module_id = $this->request->post('module_id');
        $status = 0;
        if($this->request->has('open'))
        {
            $status = 1;
        }
        $descrip = $this->request->post('descrip');
        $category_tpl = $this->request->post('category_tpl');
        $list_tpl = $this->request->post('list_tpl');
        $detail_tpl = $this->request->post('detail_tpl');

        $data = [
            'name' => $name,
            'module_id' => $module_id,
            'pid' => $pid,
            'status' => $status,
            'descrip' => $descrip,
            'category_tpl' => $category_tpl,
            'list_tpl' => $list_tpl,
            'detail_tpl' => $detail_tpl,
        ];

        if($this->menu_model->add_menu($data))
        {
            return $this->success($data);
        }else
        {
            return $this->fails(10005,'新增栏目失败');
        }
    }

    /**
     * 删除栏目
     */
    public function delete_menu()
    {
        $menu_id = $this->request->get('id');
        if($this->menu_model->delete_menu($menu_id))
        {
            return $this->success();
        }else
        {
            return $this->fails(10005,'删除栏目失败');
        }
    }


    /**
     * 编辑栏目
     */
    public function edit_menu()
    {
        $menu_id = $this->request->get('id');


        //查询模型，发送到页面
        $modules = $this->menu_model->get_modules();
        //查询菜单，发送到页面
        $data = $this->menu_model->get_menus();
        //整理菜单
        $menus = [];
        foreach ($data as $menu)
        {
            $menus[$menu['m1id']]['m1name'] = $menu['m1name'];
            $menus[$menu['m1id']]['m1id'] = $menu['m1id'];
            $menus[$menu['m1id']]['category'][] = [
                'm2id' => $menu['m2id'],
                'm2name' => $menu['m2name']
            ];
        }

        //查询模板
        //取出启用的模板
        $theme = Help::config('twig.theme');
        //取出所有的模板
        $tpls = Help::config('tpl.'.$theme);



        //获取栏目信息
        $menu_info = $this->menu_model->get_menu_info($menu_id);
        return $this->render('admin/menu/edit_menu',['menu_info' => $menu_info,'modules' => $modules,'menus'=>$menus,'tpls'=>$tpls]);
    }

    /**
     * ajax_edit_menu
     */
    public function ajax_edit_menu()
    {
        $menu_id = $this->request->post('menu_id');
        $name = $this->request->post('name');
        $pid = $this->request->post('pid');
        $module_id = $this->request->post('module_id');
        $status = 0;
        if($this->request->has('open'))
        {
            $status = 1;
        }
        $descrip = $this->request->post('descrip');
        $category_tpl = $this->request->post('category_tpl');
        $list_tpl = $this->request->post('list_tpl');
        $detail_tpl = $this->request->post('detail_tpl');

        $data = [
            'menu_id' => $menu_id,
            'name' => $name,
            'module_id' => $module_id,
            'pid' => $pid,
            'status' => $status,
            'descrip' => $descrip,
            'category_tpl' => $category_tpl,
            'list_tpl' => $list_tpl,
            'detail_tpl' => $detail_tpl,
        ];

        if($this->menu_model->edit_menu($data))
        {
            return $this->success();
        }else
        {
            return $this->fails(10005,'修改栏目失败');
        }
    }

}