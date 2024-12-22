<?php

include 'user.php';
include 'connection.php';

$userId = $_GET['id'];

$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();

$sql = "SELECT username FROM user WHERE id = '$userId'";
$data = $connection->getConnection()->query($sql);

echo json_encode($data->fetch_all(MYSQLI_NUM));
