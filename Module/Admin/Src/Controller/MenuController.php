<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 6/29/17
 * Time: 9:36 AM
 */

namespace Module\Admin\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Admin\Src\Model\Interfaces\MenuInterface;

class MenuController extends Controller
{
    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
        $this->request = new Request();
    }

    /**
     * 栏目列表
     */
    public function menu_list()
    {
        if($this->request->is_post())
        {

        }else
        {
            return $this->render('admin/menu/menu_list',['menu' => 'menu','item' => 'menu_list']);
        }
    }
}