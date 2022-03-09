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
            if ($message->getSenderId() > $message->getReseiverId()) {
                $key = $message->getReseiverId() . '-' . $message->getSenderId();
            } else {
                $key = $message->getSenderId() . '-' . $message->getReseiverId();
            }
            $chatFriendId = $message->getSenderId() == $_SESSION['user_id'] ? $message->getReseiverId() : $message->getSenderId();
            $chatFriend = new \Model\User();
            $chatFriend->load($chatFriendId);
            $chats[$key]['message'] = $message;
            $chats[$key]['chat_friend'] = $chatFriend;
        }
        usort($chats, function ($item1, $item2) {
            return $item2['message']->getId() <=> $item1['message']->getId();
        });
        $this->data['chat'] = $chats;
        $this->render('messages/all');
    }

    public function chat($chatFriendId)
    {
        $this->data['messages'] = MessageModel::getUserMessagesWithFriend($chatFriendId);
        MessageModel::makeSeen($chatFriendId, $_SESSION['user_id']);
        $this->data['reseiver_id'] = $chatFriendId;
        $this->render('messages/chat');
    }

    public function send()
    {
        $message = new MessageModel();
        $message->setMessage($_POST['message']);
        $message->setReseiverId($_POST['reseiver_id']);
        $message->setSenderId($_SESSION['user_id']);
        $message->setSeen(0);
        $message->setDate(date('Y-m-d h:i:s'));
        $message->save();
        Url::redirect('message/chat/' . $_POST['reseiver_id']);
    }
}