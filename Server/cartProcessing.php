<?php

include 'cart.php';
include 'connection.php';
include 'product.php';

$userId = $_GET['id'];

$connection = new DBConnection('localhost', 'root', '', 'thendont');
$connection->connect();
$data = Cart::getData($connection->getConnection(), $userId);

if (count($data) == 0) {
    echo 'no data found';
    exit;
}

$array = $data[0][2];

$products = [];
$temp = '';

for ($i = 0; $i < strlen($array); $i++) {
    if ($array[$i] == '[' || $array[$i] == ',' || $array[$i] == ']') {
        $products[] = Product::getProduct($connection->getConnection(), (int)$temp);
        $temp = '';
        continue;
    }
    $temp .= $array[$i];
}

$result = [];
for ($i = 0; $i < count($products); $i++) {
    if (count($products[$i]) > 0) {
        $result[] = $products[$i];
    }
}

echo json_encode($result);