<?php

include 'FormHelper.php';
$data = [
    'type' => 'text',
    'name' => 'name',
    'placeholder' => 'Vardas'
];
$data2 = [
    'type' => 'text',
    'name' => 'last_name',
    'placeholder' => 'Pavarde'
];
$data3 = [
    'type' => 'email',
    'name' => 'email',
    'placeholder' => 'john@gmail.com'
];
$data4 = [
    'type' => 'password',
    'name' => 'password',
    'placeholder' => '******'
];

$data5 = [
    'name' => 'city',
    'options' => [
        1 => 'Kaunas',
        2 => 'Vilnius',
    ]
];

$formLogin = new FormHelper('login.php', 'POST');
$formRegister = new FormHelper('register.php', 'POST');

$formRegister->input($data);
$formRegister->input($data2);
$formRegister->input($data3);
$formRegister->input($data4);
$formRegister->textArea('comment', 'Komentaras');

$formLogin->input($data3);
$formLogin->input($data4);

echo $formLogin->getForm();
echo '<br>';
echo $formRegister->getForm();

