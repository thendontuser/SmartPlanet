<?php

// Класс для работы с таблицей product
class Product {

    // Идентификатор товара
    public $id;

    // Имя товара
    public $name;

    // Описание товара
    public $description;

    // Цена товара
    public $price;

    // Количество на складе
    public $stockQuantity;

    // Идентификатор бренда
    public $brandId;

    // Конструктор. Инициализирует поля класса
    public function __construct(int $id, string $name, string $description, float $price, int $stockQuantity, int $brandId) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stockQuantity = $stockQuantity;
        $this->brandId = $brandId;
    }

    // Возвращает идентификатор
    public function getId(): int  {
        return $this->id;
    }

    // Возвращает имя товара
    public function getName(): string {
        return $this->name;
    }

    // Возвращает описание товара
    public function getDescription(): string {
        return $this->description;
    }

    // Возвращает цену товара
    public function getPrice(): float {
        return $this->price;
    }

    // Возвращает количество на складе
    public function getStockQuantity(): int {
        return $this->stockQuantity;
    }

    // Возвращает идентификатор бренда
    public function getBrandId(): int {
        return $this->brandId;
    }

    // Добавляет новый товар в таблицу
    public static function add(mysqli $connection, Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $stockQuantity = $product->getStockQuantity();
        $brandId = $product->getBrandId();
        $sql = "INSERT INTO product VALUES ($id, '$name', '$description', $price, $stockQuantity, $brandId);";
        $connection->query($sql);
    }

    // Удаляет товар из таблицы
    public static function delete(mysqli $connection, Product $product) {
        $id = $product->getId();
        $sql = "DELETE FROM product WHERE id = $id";
        $connection->query($sql);
    }

    // Обновляет запись
    public static function update(mysqli $connection, Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $stockQuantity = $product->getStockQuantity();
        $brandId = $product->getBrandId();
        $sql = "UPDATE product SET id = $id, name = '$name', description = '$description', price = '$price', stock_quantity = $stockQuantity, brand_id = $brandId;";
        $connection->query($sql);
    }

    // Получает данные из таблицы
    public static function getData(mysqli $connection): array {
        $result = [];
        $sql = "SELECT * FROM product";
        
        if ($data = $connection->query($sql)) {
            foreach ($data as $row) {
                $result[0] = $row["id"];
                $result[1] = $row["name"];
                $result[2] = $row["description"];
                $result[3] = $row["price"];
                $result[4] = $row["stock_quantity"];
                $result[5] = $row["brand_id"];
            }
        }
        return $result;
    }
}