<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 9:07 AM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Admin\Src\Model\Interfaces\AdminInterface;

class AdminController extends Controller
{
    public function __construct(AdminInterface $admin)
    {
        $this->admin_model = $admin;
        $this->request = new Request();
    }

    /**
     * 管理员列表
     */
    public function admin()
    {
        return $this->render('admin/admin/admin_list');
    }

    public function admin_lists()
    {
        $page_index = $this->request->get('pageIndex');
        $page_size = $this->request->get('pageSize');

        $name = false;

        if($this->request->has('name'))
        {
            $name = $this->request->get('name');
        }

        $data = $this->admin_model->admin_lists($page_index,$page_size,$name);

        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => $data['result'],
            'count' => $data['counts'],
        ];

        return json_encode($data);
    }

    /**
     * 添加管理员
     */
    public function add_admin()
    {

    }

    /**
     * 角色管理
     */
    public function role()
    {
        return $this->render('admin/admin/role_list');
    }

    /**
     * 角色列表
     */
    public function role_lists()
    {
        $page_index = $this->request->get('pageIndex');
        $page_size = $this->request->get('pageSize');

        $name = false;

        if($this->request->has('name'))
        {
            $name = $this->request->get('name');
        }

        $data = $this->admin_model->role_lists($page_index,$page_size,$name);

        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => $data['result'],
            'count' => $data['counts'],
        ];

        return json_encode($data);
    }

    /**
     * 添加角色
     */
    public function add_role()
    {
        return $this->render('admin/admin/add_role');
    }

    /**
     * ajax_add_role
     */
    public function ajax_add_role()
    {
        $role_name = $this->request->post('role_name');
        $data = [
            'role_name' => $role_name
        ];

        if($this->admin_model->add_role($data))
        {
            return $this->success($data);
        }else
        {
            return $this->fails(10005,'新增模型失败');
        }
    }

    /**
     * 删除角色
     */
    public function delete_role()
    {
        $role_id = $this->request->get('id');
        if($this->admin_model->delete_role($role_id))
        {
            return $this->success();
        }else
        {
            return $this->fails(10005,'删除角色失败');
        }
    }
}