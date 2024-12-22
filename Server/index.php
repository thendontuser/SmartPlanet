<?php

// Файля для запуска сервера

include 'connection.php';
include 'brand.php';
include 'product.php';
include 'user.php';

// Создание объекта базы данных
$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();

$samsung = '../images/samsungsgalaxy.jpg';
$iphone15pro = '../images/iphone15pro.jpg';
$iphone15promax = '../images/iphone15promax.jpg';

//Product::update($connection->getConnection(), new Product(1, 'Samsung S Galaxy', 'Новый смартвон Samsung S galaxy, надежный и стильный', 20000, 50, 1, $samsung));
//Product::update($connection->getConnection(), new Product(2, 'Iphone 15 Pro', 'Новый флагман от Apple', 70000, 100, 3, $iphone15pro));
//Product::update($connection->getConnection(), new Product(3, 'Iphone 15 Pro Max', 'Новый флагман от Apple максимальной комплектации', 80000, 100, 3, $iphone15promax));

$product = Product::getData($connection->getConnection());
//$brand = Brand::getData($connection->getConnection());

//User::add($connection->getConnection(), new User(1, 'Андрей', 'Крутов', '78543674567', 'ak', 'a'));


// Disable CORS
header('Content-Type: application/json');

echo json_encode($product, JSON_UNESCAPED_UNICODE);
// echo json_encode($data);