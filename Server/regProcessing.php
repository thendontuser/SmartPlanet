<?php

include 'user.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $connection = new DBConnection('localhost', 'root', '', 'thendont');
    $connection->connect();

    if (User::isExists($connection->getConnection(), $login)) {
        echo json_encode(['success' => false, 'message' => 'Пользователь уже существует']);
    }
    else {
        User::add($connection->getConnection(), new User($phone, $password, $login));
        echo json_encode(['success' => true, 'message' => 'Успешная регистрация']);
    }
}