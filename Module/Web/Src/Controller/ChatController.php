<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 7/5/17
 * Time: 2:03 AM
 */

namespace Module\Web\Src\Controller;

use Lib\Controller;
use Module\Web\Src\Model\Interfaces\ChatInterface;

class ChatController extends Controller
{
    public function __construct(ChatInterface $chat)
    {
        $this->chat = $chat;
    }

    public function chat()
    {
        return $this->render('web/chat/chat');
    }
}