<?php

// Файля для запуска сервера

include 'connection.php';
include 'brand.php';
include 'product.php';

// Создание объекта базы данных
$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();
$record_id = $_GET['id'];
$product = Product::getData($connection->getConnection());

// Disable CORS
header('Content-Type: application/json');

echo json_encode($product, JSON_UNESCAPED_UNICODE);
// echo json_encode($data);