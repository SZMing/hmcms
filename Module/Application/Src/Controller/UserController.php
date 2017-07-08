<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 17-6-13
 * Time: 下午1:24
 */

namespace Module\Application\Src\Controller;

use Lib\Controller;
use Module\Application\Src\Model\Interfaces\ArticleInterface;
use Module\Application\Src\Model\Interfaces\UserInterface;

class UserController extends Controller
{
    private $user_model;
    private $article_model;

    public function __construct(UserInterface $user,ArticleInterface $article)
    {
        $this->user_model = $user;
        $this->article_model = $article;
    }

    public function index()
    {
        return $this->success(['asdfasdfsda']);
    }
}