<?php

namespace Controller;

use Core\AbstractController;

class Catalog extends AbstractController
{
    public function show($id = null)
    {
        if ($id !== null) {
            echo 'Catalog controller ID ' . $id;
        }
    }

    public function all()
    {
        $this->render('catalog/all');
    }

    public function create()
    {

    }

    public function update($data)
    {
        echo 'I\'m Robot';
    }
}

