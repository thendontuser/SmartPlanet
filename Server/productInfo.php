<?php

// Файл для запуска сервера

include 'connection.php';
include 'brand.php';
include 'product.php';

// Создание объекта базы данных
$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();
$record_id = $_GET['id'];
$product = Product::getProduct($connection->getConnection(), (int)$record_id);

// Disable CORS
header('Content-Type: application/json');

echo json_encode($product, JSON_UNESCAPED_UNICODE);
// echo json_encode($data);