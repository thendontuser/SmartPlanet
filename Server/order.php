<?php

// Класс для работы с таблицей Order
class Order {

    // Идентификатор пользователя
    private $userId;

    // Идентификатор товара
    private $productId;

    // Дата заказа
    private $date;

    // Статус заказа
    private $status;

    // Адрес отправления
    private $shippingAddress;

    // Конструктор. Инициализиурет все поля класса
    public function __construct(int $userId, int $productId, string $date, string $status, string $shippingAddress) {
        $this->userId = $userId;
        $this->productId = $productId;
        $this->date = $date;
        $this->status = $status;
        $this->shippingAddress = $shippingAddress;
    }

    // Возвращает ID пользователя
    public function getUserId(): int {
        return $this->userId;
    }

    // Возвращает ID товара
    public function getProductId(): int {
        return $this->productId;
    }

    // Возвращает дату заказа
    public function getDate(): string {
        return $this->date;
    }

    // Возвращает статус заказа
    public function getStatus(): string {
        return $this->status;
    }

    // Возвращает адрес отправки
    public function getShippingAddress(): string {
        return $this->shippingAddress;
    }

    // Добавляет новый заказ в таблицу
    public static function add(mysqli $connection, Order $order) {
        $userId = $order->getUserId();
        $productId = $order->getProductId();
        $date = $order->getDate();
        $status = $order->getStatus();
        $shippingAddress = $order->getShippingAddress();
        $sql = "INSERT INTO orders (date, status, shipping_address, user_id, product_id) VALUES ('$date', '$status', '$shippingAddress', '$userId', '$productId');";
        $connection->query($sql);
    }

    // Получает данные из таблицы
    public static function getData(mysqli $connection): array {
        $sql = "SELECT * FROM orders";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }
}