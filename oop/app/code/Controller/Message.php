<?php

namespace Controller;

use Core\AbstractController;
use Core\Interfaces\ControllerInterface;
use Helper\Url;
use Model\Message as MessageModel;

class Message extends AbstractController implements ControllerInterface
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->isUserLoged()) {
            Url::redirect('user/login');
        }
    }

    public function index()
    {
        $messages = MessageModel::getUserRelatedMessages();
        $chats = [];

        foreach ($messages as $message) {
//            if ($message->getSenderId() > $message->getReseiverId()) {
//                $key = $message->getReseiverId() . '-' . $message->getSenderId();
//            } else {
//                $key = $message->getSenderId() . '-' . $message->getReseiverId();
//            }
            $chatFriendId = $message->getSenderId() == $_SESSION['user_id'] ? $message->getReseiverId() : $message->getSenderId();
            $chatFriend = new \Model\User();
            $chatFriend->load($chatFriendId);
            $chats[$chatFriendId]['message'] = $message;
            $chats[$chatFriendId]['chat_friend'] = $chatFriend;
        }
        $this->data['chat'] = $chats;
        $this->render('messages/all');
    }
}