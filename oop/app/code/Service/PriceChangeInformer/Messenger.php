<?php 

namespace Service\PriceChangeInformer;

use Model\SavedAd;
use Helper\DBHelper;

class Messenger
{
    public function setMessages($adId)
    {
        $userIds = SavedAd::getUsersIdsByAd($adId);
        foreach($userIds as $userId){
            $db = new DBHelper();
            $data = [
                'user_id' => $userId,
                'ad_id' => $adId
            ];
            $db->insert('price_informer_queue',$data)->exec();
        }
    }
}
