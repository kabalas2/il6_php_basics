<?php

namespace Controller;

use Core\AbstractController;
use Helper\FormHelper;
use Helper\Url;
use Helper\Validator;
use Model\City;
use Model\User;
use Model\User as UserModel;

class Admin extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->isUserAdmin()) {
            Url::redirect('');
        }
    }

    public function index()
    {
        $this->renderAdmin('index');
    }

    public function users()
    {
        $this->data['users'] = User::getAllUsers();
        $this->renderAdmin('users/list');
    }

    public function useredit($id)
    {
        $user = new User();
        $user->load($id);

        $form = new FormHelper('admin/userupdate', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Vardas',
            'value' => $user->getName()
        ]);
        $form->input([
            'name' => 'user_id',
            'type' => 'hidden',
            'value' => $id
        ]);

        $form->input([
            'name' => 'last_name',
            'type' => 'text',
            'placeholder' => 'Pavarde',
            'value' => $user->getLastName()
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+3706*******',
            'value' => $user->getPhone()
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Email',
            'value' => $user->getEmail()
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

        $form->select([
            'name' => 'city_id',
            'options' => $options,
            'selected' => $user->getCityId()
        ]);

        $form->select([
            'name' => 'active',
            'options' => [0 => 'not active', 1 => 'active'],
            'selected' => $user->isActive()
        ]);

        $form->input([
            'name' => 'create',
            'type' => 'submit',
            'value' => 'Save'
        ]);

        $this->data['form'] = $form->getForm();
        $this->renderAdmin('users/edit');
    }

    public function userupdate()
    {
        $userId = $_POST['user_id'];
        $user = new UserModel();
        $user->load($userId);

        $user->setName($_POST['name']);
        $user->setLastName($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setCityId($_POST['city_id']);
        $user->setActive($_POST['active']);

        if ($_POST['password'] != '' && Validator::checkPassword($_POST['password'], $_POST['password2'])) {
            $user->setPassword(md5($_POST['password']));
        }

        if ($user->getEmail() != $_POST['email']) {
            if (Validator::checkEmail($_POST['email']) && UserModel::isValueUnic('email', $_POST['email'], 'users')) {
                $user->setEmail($_POST['email']);
            }
        }

        $user->save();
        Url::redirect('admin/users');
    }
}