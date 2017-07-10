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
    public function admin_list()
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

        //var_dump($data);

        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => $data['result'],
            'count' => $data['counts'],
        ];


        //return $this->success($data);
        return json_encode($data);
    }
}