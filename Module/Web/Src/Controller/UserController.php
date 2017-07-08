<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-16
 * Time: 下午3:30
 */

namespace Module\Web\Src\Controller;

use Lib\Controller;

class UserController extends Controller
{
    public function index()
    {
        return $this->render('web/user/index');
    }
}