<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/30/17
 * Time: 7:53 AM
 */

namespace Module\Web\Src\Controller;

use Lib\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return $this->render('web/web/index');
    }
}