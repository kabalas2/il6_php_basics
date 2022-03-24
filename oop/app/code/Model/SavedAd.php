<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class SavedAd extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'saved_ads';

    private int $userId;

    private int $adId;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getAdId(): int
    {
        return $this->adId;
    }

    /**
     * @param int $adId
     */
    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }

    public function load(int $id): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if (!empty($rez)) {
            $this->id = $rez['id'];
            $this->adId = $rez['ad_id'];
            $this->userId = $rez['user_id'];
            return $this;
        }
        return null;
    }

    public function loadByUserAndAd($userId, $adId)
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('user_id', $userId)->andWhere('ad_id', $adId)->getOne();
        if (!empty($rez)) {
            $this->load((int)$rez['id']);
            return $this;
        }
        return null;
    }

    public function assignData()
    {
        $this->data = [
            'user_id' => $this->userId,
            'ad_id' => $this->adId
        ];
    }

    public static function getUsersFavoriteAds($userId)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('user_id', $userId)->get();
        $ads = [];
        foreach ($data as $element) {
            $ad = new Ad();
            $ad->load((int)$element['ad_id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getUsersIdsByAd($adId)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('ad_id', $adId)->get();
        $usersIds = [];
        foreach ($data as $element) {
            $usersIds[] = $element['user_id'];
        }
        return $usersIds;
    }
}
