<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/4/17
 * Time: 4:31 AM
 */

namespace Module\Web\Src\Controller;

use Lib\Controller;
use Lib\Request;
use Module\Web\Src\Model\Interfaces\ApplyInterface;

class ApplyController extends Controller
{
    public function __construct(ApplyInterface $apply)
    {
        $this->apply_model = $apply;
        $this->request = new Request();
    }

    public function apply()
    {
        return $this->render('web/apply/apply');
    }


}