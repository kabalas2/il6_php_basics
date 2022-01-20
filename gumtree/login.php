<?php

$email = $_POST['email'];
$userPassword = md5($_POST['password']); // admin123

$servername = "localhost";
$username = "root";
$password = "root";
$dbName = 'shop_lt';

try {
//mysql:host=localhost;dbname=shop_lt
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch (PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
}


$sql = 'SELECT * FROM users WHERE email ="'.$email.'" AND password = "'.$userPassword.'"';

$rez = $conn->query($sql);
$user = $rez->fetchAll();

if(!empty($user)){
    //
}else{
    echo 'Patikrinkite prisijungimo duomenis.';
}