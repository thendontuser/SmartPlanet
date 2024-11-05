<?php

// Класс для работы с базой данных
class DataBase
{
    // Имя хоста
    private $host;

    // Имя пользователя
    private $username;

    // Пароль
    private $password;

    // Имя базы данных
    private $database;

    // Глобальная переменная для подключения к базе данных. Используется для запросов к базе
    private $connection;

    // Конструктор. Инициализиурет все поля класса
    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connection = null;
    }

    // Подключается к базе данных
    public function connect() {
        try {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            echo "successful!";
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    // Закрывает подключение
    public function disconnect() {
        try {
            $this->connection->close();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}