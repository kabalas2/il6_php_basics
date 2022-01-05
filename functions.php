<?php


// $productArray = [
//     'name' => 'Batai',
//     'price' => '12',
//     'shop-working-hours' => '9.00 - 18.00'
// ];
// $productPrice = 12;
// $discount = 20;

// $productPrice2 = 13;
// $discount2 = 30;

// $finalPrice = getFinalPrice($productPrice, $discount);
// $finalPrice2 = getFinalPrice($productPrice2, $discount2);

// // echo '<div class="price">'.$finalPrice. '</div>';
// // echo '<div class="price">'.$finalPrice2. '</div>';

// function getFinalPrice($price, $discount){
//     $finalPriceWithoutTaxes = $price * ((100 - $discount)/100);
//     $finalPriceWithTaxes = getPriceWithTax($finalPriceWithoutTaxes);
//     return $finalPriceWithTaxes;
// }

// function getPriceWithTax($price){
//     return $price * 1.21;
// }

// function funkciosPavadinimas($kinamieji, $kuriuos, $siusim){
//     // code
//     return null;
// }

// $userEmail = 'arnoldas.t@emotion.lt';
// $userEmail = 'arnoldas.temotion.lt ';
// $userEmail = 'Arnoldas.temotion.lt';


//  // $email = $userEmail
//  // $email = 'Naujas@Emailas.lt'
function clearEmail($email){
    $emailLowercases = strtolower($email);
    return trim($emailLowercases);
}

// function isEmailValid($email){
  
//     if(strpos($email, '@')){
//         return true;
//     }else{
//         return false;
//     }
    
   

// }

// if(isEmailValid($userEmail)){
//     echo clearEmail($userEmail);
// }else{
//     echo 'Emailas nevalidus';
// }

$name = 'Arnoldas';
$surname = 'Turulis';

// arntur;
echo getNickName($name, $surname);

function getNickName($name, $surName){
    // $name Arn;
    // $surName 
}

// Korona vis dar nesitraukia

// slug
// korona-vis-dar-nesitraukia



function getSlug($string){
    $string = str_replace(' ', '-', $string);
    $string = strtolower($string);
    return $string;
}











