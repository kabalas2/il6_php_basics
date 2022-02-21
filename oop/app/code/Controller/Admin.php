<?php

namespace Controller;

use Core\AbstractController;
use Helper\Url;
use Model\User;

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

    }
}
