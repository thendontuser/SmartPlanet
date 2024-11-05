<?php

// Файля для запуска сервера

include 'connection.php';

// Создание объекта базы данных
$connection = new DataBase('localhost', 'root', '', 'thendont');

$connection->connect();