<?php

// Класс для работы с таблицей cart
class Cart {

    // идентификатор корзины
    private $id;

    // идентификатор пользователя
    private $userId;

    // массив идентификаторов товаров
    private $productsId;

    // Конструктор. Инициализирует поля класса
    public function __construct(int $id, int $userId, array $productsId) {
        $this->id = $id;
        $this->userId = $userId;
        $this->productsId = $productsId;
    }

    // Получает идентификатор записи
    public function getId(): int {
        return $this->id;
    }

    // Получает идентификатор пользователя
    public function getUserId(): int {
        return $this->userId;
    }

    // Получает список идентификаторов товаров
    public function getProductsId(): array {
        return $this->productsId;
    }

    // Добавляет новую запись
    public static function add(mysqli $connection, Cart $cart) {
        $id = $cart->getId();
        $userId = $cart->getUserId();
        $productsId = json_encode($cart->getProductsId());
        $sql = "INSERT INTO cart VALUES ('$id', '$userId', '$productsId');";
        $connection->query($sql);
    }

    // Обновляет запись
    public static function update(mysqli $connection, Cart $cart) {
        $id = $cart->getId();
        $userId = $cart->getUserId();
        $productsId = json_encode($cart->getProductsId());
        $sql = "UPDATE cart SET user_id = '$userId', products_id = '$productsId' WHERE id = '$id';";
        $connection->query($sql);
    }

    // Удаляет запись запись
    public static function delete(mysqli $connection, int $id) {
        $sql = "DELETE FROM cart WHERE id = '$id'";
        $connection->query($sql);
    }

    // Получает все записи таблицы
    public static function getData(mysqli $connection, int $userId): array {
        $sql = "SELECT * FROM cart WHERE user_id = '$userId'";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }
}