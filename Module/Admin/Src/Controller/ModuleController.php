<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/9/17
 * Time: 11:21 PM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Admin\Src\Model\Interfaces\ModuleInterface;

class ModuleController extends Controller
{
    public function __construct(ModuleInterface $module)
    {
        $this->module_model = $module;
        $this->request = new Request();
    }

    /**
     * 模型管理
     */
    public function module()
    {
        return $this->render('admin/module/module');
    }

    /**
     * 获取模型列表
     */
    public function module_lists()
    {
        $page_index = $this->request->get('pageIndex');
        $page_size = $this->request->get('pageSize');

        $name = false;

        if($this->request->has('name'))
        {
            $name = $this->request->get('name');
        }

        $data = $this->module_model->module_lists($page_index,$page_size,$name);

        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => $data['result'],
            'count' => $data['counts'],
        ];

        return json_encode($data);
    }

    /**
     * 添加模型视图
     */
    public function add_module()
    {
        return $this->render('admin/module/add_module');
    }

    /**
     * 处理ajax的添加
     */
    public function ajax_add_module()
    {
        $name = $this->request->post('name');
        $module_type = $this->request->post('module_type');
        $status = 0;
        if($this->request->has('open'))
        {
            $status = 1;
        }
        $descrip = $this->request->post('descrip');

        $data = [
            'name' => $name,
            'module_type' => $module_type,
            'status' => $status,
            'descrip' => $descrip,
        ];

        if($this->module_model->add_module($data))
        {
            return $this->success($data);
        }else
        {
            return $this->fails(10005,'新增模型失败');
        }
    }

    /**
     * 删除模型
     */
    public function delete_module()
    {
        $module_id = $this->request->get('id');
        if($this->module_model->delete_module($module_id))
        {
            return $this->success();
        }else
        {
            return $this->fails(10005,'删除模型失败');
        }
    }
}