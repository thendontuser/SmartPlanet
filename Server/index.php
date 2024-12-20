<?php

// Файля для запуска сервера

include 'connection.php';
include 'brand.php';
include 'product.php';
include 'user.php';

// Создание объекта базы данных
$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();

Product::update($connection->getConnection(), new Product(1, 'Samsung S Galaxy', 'This is Samsung S Galaxy, new model', 20000, 65, 1, 'samsung s galaxy.jpg'));

$product = Product::getData($connection->getConnection());
$brand = Brand::getData($connection->getConnection());


// Disable CORS
header('Content-Type: application/json');

echo json_encode($product, JSON_UNESCAPED_UNICODE);
// echo json_encode($data);