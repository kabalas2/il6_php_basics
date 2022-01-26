<?php

namespace Controller;

class Catalog
{
    public function show($id)
    {
        echo 'Catalog controller ID ' . $id;
    }

    public function all()
    {
        for($i = 0; $i < 10; $i++){
            echo '<a href="http://127.0.0.1:8001/index.php/catalog/show/'.$i.'">Read more</a>';
            echo '<br>';
        }
    }

    public function create($data)
    {

    }

    public function update($data)
    {
        echo 'I\'m Robot';
    }
}

