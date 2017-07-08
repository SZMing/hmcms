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
        if($this->request->is_post())
        {

        }else
        {
            return $this->render('admin/admin/admin_list',['admin_list' => $this->admin_model::admin_list(),'menu' => 'admin','item' => 'admin_list']);
        }
    }
}