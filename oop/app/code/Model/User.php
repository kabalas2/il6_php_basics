<?php

namespace Model;

use Helper\DBHelper;

class User
{

    public static function emailUnic($email)
    {
        $db = new DBHelper();
        $rez = $db->select()->from('user')->where('email', $email)->get();
        return empty($rez);
    }

}