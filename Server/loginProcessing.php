<?php

include 'user.php';
include 'connection.php';

$state = -1;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = $_POST['username'];
    $password = $_POST['password'];

    $connection = new DBConnection('localhost', 'root', '', 'thendont');
    $connection->connect();
    $data = User::getData($connection->getConnection());

    for ($i = 0; $i < count($data); $i++) {
        if (strcmp($login, $data[$i][3]) == 0 && password_verify($password, $data[$i][2])) {
            $state = 0;
            echo json_encode(['success' => true, 'id' => $data[$i][0]]);
            break;
        }
    }

    if ($state == -1) {
        echo json_encode(['success' => false, 'message' => 'Пользователь не найден']);
    }
}