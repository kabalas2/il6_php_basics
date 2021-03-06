<?php

namespace Service\PriceChangeInformer;

use Model\Message;
use Helper\DBHelper;
use Model\Ad;
use Model\User;

class Cron
{
    public function exec()
    {
        $db = new DBHelper;
        $data = $db->select()->from('price_informer_queue')->limit(100)->get();
        foreach($data as $element){
            $user = new User();
            $user->load($element['user_id']);
            $ad = new Ad($element['ad_id']);
            $messageText = "Sveiki $user->getName(), Automobilis $ad->getTitle() pakeite kaina, gal jums butu idomu suzinoti";
            $message = new Message();
            $message->setMessage($messageText);
            $message->setReseiverId($user->getId());
            $message->setSenderId(1);
            $message->setSeen(0);
            $message->setDate(date('Y-m-d h:i:s'));
            $message->save();
            $db = new DBHelper();
            $db->delete()->from('price_informer_queue')->where('id', $element['id'])->exec();
        }
    }
}