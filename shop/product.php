<?php
include 'helper.php';
$id = $_GET['id'];
$product = getProductById($id);

debug($product);