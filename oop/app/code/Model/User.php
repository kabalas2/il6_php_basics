<?php

namespace Model;

use Helper\DBHelper;

class User
{
    private $id;

    private $name;

    private $lastName;

    private $email;

    private $password;

    private $phone;

    private $cityId;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCityId()
    {
        return $this->cityId;
    }

    public function setCityId($id)
    {
        $this->cityId = $id;
    }


    public static function emailUnic($email)
    {
        $db = new DBHelper();
        $rez = $db->select()->from('user')->where('email', $email)->get();
        return empty($rez);
    }

}