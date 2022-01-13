<?php

// <input type="text" name="kazkaz" placeholder="">
// <input type="password" name="password" placeholder="****">
//[
//    'type' => 'text',
//    'name' => 'name',
//    'placeholder' => 'Vardas'
//],
function generateInput($data){
    $input = '';
    $input .= '<input ';
    // <input type="text" name="name" placeholder="Vardas" >
    foreach ($data as $key => $value){
        $input .= $key.'="'.$value.'" ';
    }
    $input .= '>';
    return $input;
}

function generateSelect($data){

}


// <select name="childrens_count">
// <option value="0">0</option>
//</select>
