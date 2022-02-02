<?php

namespace Controller;

use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Validator;
use Model\City;
use Model\User as UserModel;

class User
{
    public function show($id)
    {
        echo 'User controller ID: ' . $id;
    }

    public function register()
    {

        $form = new FormHelper('user/create', 'POST');

        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas'
        ]);
        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde'
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******'
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'name' => 'password2',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);

        $cities = City::getCities();
        $options = [];
        foreach ($cities as $city) {
            $id = $city->getId();
            $options[$id] = $city->getName();
        }
        $form->select(['name' => 'city_id', 'options' => $options]);
        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'register'
        ]);

        echo $form->getForm();
    }

    public function login()
    {
        $form = new FormHelper('user/check', 'POST');
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'password',
            'type' => 'password',
            'placeholder' => '* * * * * *'
        ]);
        $form->input([
            'name' => 'login',
            'type' => 'submit',
            'value' => 'login'
        ]);

        echo $form->getForm();
    }

    public function create()
    {
        $passMatch = Validator::checkPassword($_POST['password'], $_POST['password2']);
        $isEmailValid = Validator::checkEmail($_POST['email']);
        $isEmailUnic = UserModel::emailUnic($_POST['email']);
        if ($passMatch && $isEmailValid && $isEmailUnic) {
            $user = new UserModel();
            $user->setName($_POST['name']);
            $user->setLastName($_POST['last_name']);
            $user->setPhone($_POST['phone']);
            $user->setPassword(md5($_POST['password']));
            $user->setEmail($_POST['email']);
            $user->setCityId($_POST['city_id']);
            $user->save();
        }
    }

    public function check()
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $userId = UserModel::checkLoginCredentionals($email, $password);
        if ($userId) {
            $user = new UserModel();
            $user->load($userId);
        } else {
            echo 'Something goes wrong';
        }

    }

}