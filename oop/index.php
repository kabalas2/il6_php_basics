<?php

include 'FormHelper.php';
$data = [
    'type' => 'text',
    'name' => 'name',
    'placeholder' => 'Vardas'
];
$form = new FormHelper('register.php', 'POST');
$form->input($data);
$form->input($data);
echo $form->getForm();