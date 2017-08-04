<?php
$users = [
    1 => [
        'username' => 'pesho',
        'password' => '123'
    ],
    2 => [
        'username' => 'gosho',
        'password' => '321'
    ]
];
var_dump($_GET);
var_dump($_POST);

$username = $_POST['username'];
$password = $_POST['password'];

//file_put_contents("users.txt", "username: " . $username . " ||| password: " . $password);