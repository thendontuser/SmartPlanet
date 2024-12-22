<?php

include 'cart.php';
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userId = $_POST['userId'];
    $productId = $_POST['productId'];

    $connection = new DBConnection('localhost', 'root', '', 'thendont');
    $connection->connect();

    $cart = Cart::getData($connection->getConnection(), $userId);
    $productsId = [];
    if (count($cart) == 0) {
        $productsId[] = (int)$productId;
        Cart::add($connection->getConnection(), new Cart(0, $userId, $productsId));
    }
    else {
        $productsId = json_decode($cart[0][2]);
        $productsId[] = (int)$productId;
        Cart::update($connection->getConnection(), new Cart((int)$cart[0][0], $userId, $productsId));
    }
    echo 'successful';
}