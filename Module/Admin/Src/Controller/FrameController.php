<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 4:19 AM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;

class FrameController extends Controller
{
    /**
     * 后台首页
     */
    public function index()
    {
        return $this->render('admin/frame/index');
    }

    /**
     * 后台登录界面
     */
    public function login()
    {
        return $this->render('admin/frame/login');
    }
}

