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
        $data = [
            'rel' => true,
            'msg' => '获取成功',
            'list' => [
                ['name' => '张三', 'age' => 21 , 'createtime' => "2017-01-10 10:42:36"],
                ['name' => '张三', 'age' => 21 , 'createtime' => "2017-01-10 10:42:36"],
                ['name' => '张三', 'age' => 21 , 'createtime' => "2017-01-10 10:42:36"],
                ['name' => '张三', 'age' => 21 , 'createtime' => "2017-01-10 10:42:36"],
                ['name' => '张三', 'age' => 21 , 'createtime' => "2017-01-10 10:42:36"],
            ],
            'count' => 57,
        ];
        //return $this->success($data);
        return json_encode($data);
    }
}