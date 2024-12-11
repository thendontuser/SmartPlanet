<?php

include 'user.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = $_POST['username'];
    $password = $_POST['password'];

    $connection = new DBConnection('localhost', 'root', '', 'thendont');
    $connection->connect();
    $data = User::getData($connection->getConnection());

    if (strcmp($login, $data[5]) && strcmp(hash('sha512', $password), $data[4])) {
        echo json_encode('login!');
    }
    else {
        echo json_encode('oh shit!');
    }
    //echo json_encode([$login, $password], JSON_UNESCAPED_UNICODE);
}