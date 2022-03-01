<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Comment extends AbstractModel implements ModelInterface
{
    public const TABLE = 'comments';

    private $userId;

    private $adId;

    private $date;

    private $message;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getAdId()
    {
        return $this->adId;
    }

    /**
     * @param mixed $adId
     */
    public function setAdId($adId): void
    {
        $this->adId = $adId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function load($id)
    {
        $db = new DBHelper();
        $comment = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($comment)) {
           $this->id = $comment['id'];
           $this->userId = $comment['user_id'];
           $this->adId = $comment['ad_id'];
           $this->message = $comment['message'];
           $this->date = $comment['data'];
        }

        return $this;
    }

    public function assignData()
    {
        $this->data = [
            'id' => $this->id,
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
            'date' => $this->date,
            'message' => $this->message
        ];
    }
}