<?php

// Класс для работы с таблицей product
class Product {

    // Идентификатор товара
    private $id;

    // Имя товара
    private $name;

    // Описание товара
    private $description;

    // Цена товара
    private $price;

    // Количество на складе
    private $stockQuantity;

    // Идентификатор бренда
    private $brandId;

    // Путь к изображению
    private $filePath;

    // Конструктор. Инициализирует поля класса
    public function __construct(int $id, string $name, string $description, float $price, int $stockQuantity, int $brandId, string $filePath) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stockQuantity = $stockQuantity;
        $this->brandId = $brandId;
        $this->filePath = $filePath;
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

    // Возвращает путь к изображению
    public function getFilePath(): string {
        return $this->filePath;
    }

    public function getImage(mysqli $connection, string $filePath): string {
        if (!file_exists($filePath)) {
            echo "Файл не найден.";
            return null;
        }

        $check = getimagesize($filePath);
        if ($check === false) {
            echo "Файл не является изображением.";
            return null;
        }

        $imageData = file_get_contents($filePath);
        return $imageData;
    }

    // Удаляет товар из таблицы
    public static function delete(mysqli $connection, Product $product) {
        $id = $product->getId();
        $sql = "DELETE FROM product WHERE id = $id";
        $connection->query($sql);
    }

    public static function add(mysqli $connection, Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $stockQuantity = $product->getStockQuantity();
        $brandId = $product->getBrandId();
        $image = $product->getFilePath();

        $sql = $connection->prepare("INSERT INTO product (id, name, description, price, stock_quantity, brand_id, image) VALUES (?, ?, ?, ?, ?, ?, ?);");
        if ($sql) {
            $sql->bind_param("issdiis", $id, $name, $description, $price, $stockQuantity, $brandId, $image);
            if (!$sql->execute()) {
                echo "Ошибка при загрузке изображения в базу данных.";
            }
            $sql->close();
        } else {
            echo "Ошибка подготовки запроса: " . $connection->error;
        }
    }

    // Обновляет запись
    public static function update(mysqli $connection, Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $stockQuantity = $product->getStockQuantity();
        $brandId = $product->getBrandId();
        $image = $product->getFilePath();

        $sql = $connection->prepare("UPDATE product SET name = ?, description = ?, price = ?, stock_quantity = ?, brand_id = ?, image = ? WHERE id = ?;");
        if ($sql) {
            $sql->bind_param("ssdiisi",$name, $description, $price, $stockQuantity, $brandId, $image, $id);
            if (!$sql->execute()) {
                echo "Ошибка при загрузке изображения в базу данных.";
            }
            $sql->close();
        } else {
            echo "Ошибка подготовки запроса: " . $connection->error;
        }
    }

    // Получает один товар по id
    public static function getProduct(mysqli $connection, int $id): array {
        $sql = "SELECT * FROM product WHERE id = $id";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }

    // Получает данные из таблицы
    public static function getData(mysqli $connection): array {
        $sql = "SELECT * FROM product";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }
}