<?php

// Файля для запуска сервера

include 'connection.php';
include 'brand.php';
include 'product.php';

// Создание объекта базы данных
$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();

/*$brand = new Brand(1, 'samsung', 'samsung desc');
Brand::add($connection->getConnection(), $brand);
Brand::add($connection->getConnection(), new Brand(2, 'poco', 'poco desc'));*/

//Product::add($connection->getConnection(), new Product(1, 'samsung s galaxy', 'samsung', 20000, 100, 1));

$data = Product::getData($connection->getConnection());
$index = 0;
foreach (array_values($data) as $key => $value) {
    echo $value;
    echo ' ';
}