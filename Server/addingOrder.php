<?php

include 'connection.php';
include 'order.php';

$productId = $_POST['productId'];
$userId = $_POST['userId'];
$address = $_POST['address'];

$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();

Order::add($connection->getConnection(), new Order($userId, $productId, date('d-m-y'), 'В пути', $address));

echo 'Заказ оформлен';