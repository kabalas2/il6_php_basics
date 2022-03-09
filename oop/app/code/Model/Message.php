<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Message extends AbstractModel implements ModelInterface
{
    public const TABLE = 'messages';

    private string $message;

    private int $senderId;

    private int $reseiverId;

    private string $date;

    private bool $seen;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getSenderId(): int
    {
        return $this->senderId;
    }

    /**
     * @param int $senderId
     */
    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * @return int
     */
    public function getReseiverId(): int
    {
        return $this->reseiverId;
    }

    /**
     * @param int $reseiverId
     */
    public function setReseiverId(int $reseiverId): void
    {
        $this->reseiverId = $reseiverId;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return bool
     */
    public function isSeen(): bool
    {
        return $this->seen;
    }

    /**
     * @param bool $seen
     */
    public function setSeen(bool $seen): void
    {
        $this->seen = $seen;
    }

    public function load(int $id): object
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($rez)) {
            $this->id = $rez['id'];
            $this->message = $rez['message'];
            $this->senderId = $rez['sender_id'];
            $this->reseiverId = $rez['reseiver_id'];
            $this->seen = $rez['seen'];
            $this->date = $rez['date'];
        }
        return $this;
    }

    public function assignData()
    {
        $this->data = [
            'message' => $this->message,
            'sender_id' => $this->senderId,
            'reseiver_id' => $this->reseiverId,
            'seen' => $this->seen
        ];
    }

    public static function getUnreadMessagesCount()
    {
        $db = new DBHelper();
        $rez = $db->select('COUNT(*)')->from(self::TABLE)->where('reseiver_id', $_SESSION['user_id'])->andWhere('seen', 0)->get();
        return (int)$rez[0][0];
    }

    public static function getUserRelatedMessages()
    {
        $db = new DBHelper();
        $userId= $_SESSION['user_id'];
        $data = $db->select()->from(self::TABLE)->where('sender_id', $userId)->orWhere('reseiver_id', $userId)->get();
        $messages = [];
        foreach ($data as $elemetn){
            $message = new Message();
            $message->load($elemetn['id']);
            $messages[] = $message;
        }
        return $messages;
    }

    public static function getUserMessagesWithFriend($friendId)
    {
        $db = new DBHelper();
        $userId= $_SESSION['user_id'];
        $data = $db->select()->from(self::TABLE)->where('sender_id', $userId)->andWhere('reseiver_id', $friendId)->orWhere('reseiver_id', $userId)->andWhere('sender_id', $friendId)->get();
        $messages = [];
        foreach ($data as $elemetn){
            $message = new Message();
            $message->load($elemetn['id']);
            $messages[] = $message;
        }
        return $messages;
    }
}