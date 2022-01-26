<?php

include 'vendor/autoload.php';

if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '/'){
    $path = trim($_SERVER['PATH_INFO'],'/');
    echo '<pre>';
    $path = explode('/',$path);
    print_r($path);
    $class = ucfirst($path[0]);
    $method = $path[1];
    $param = $path[2];
    //echo 'app/code/Controller/'.$class.'.php';

//    $obj = new $class();
    $class = '\Controller\\'.$class;
    $obj = new $class();


    $obj->$method($param);


}else{
    echo 'home page';
}

// domain.lt/controlleris/methodas/params