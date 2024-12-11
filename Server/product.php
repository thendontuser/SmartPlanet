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
    private $imageName;

    private $imageDirectory;

    // Конструктор. Инициализирует поля класса
    public function __construct(int $id, string $name, string $description, float $price, int $stockQuantity, int $brandId, string $imageName) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stockQuantity = $stockQuantity;
        $this->brandId = $brandId;
        $this->imageName = $imageName;
        $this->imageDirectory = 'C:\Users\andrk\Desktop\лабы\3 курс 1 семестр\web\курсач\frontend\images';
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
    public function getImageName(): string {
        return $this->imageName;
    }

    public function getImage(mysqli $connection, string $imgName): string {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
            $targetDir = $this->imageDirectory; // Директория для загрузки изображений
            $targetFile = $targetDir.basename($_FILES['image'][$imgName]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
     
            // Проверка, является ли файл изображением
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                echo "Файл является изображением - " . $check['mime'] . ".";
                $uploadOk = 1;
            } else {
                echo "Файл не является изображением.";
                $uploadOk = 0;
            }
     
            // Проверка на наличие ошибок при загрузке
            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "Ошибка при загрузке файла.";
                $uploadOk = 0;
            }
     
            // Проверка на существование файла
            if (file_exists($targetFile)) {
                echo "Изображение уже существует.";
                $uploadOk = 0;
            }
     
            // Ограничение на размер файла (например, 5MB)
            if ($_FILES['image']['size'] > 5000000) {
                echo "Изображение слишком большое.";
                $uploadOk = 0;
            }
     
            // Разрешенные форматы файлов
            if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                echo "Разрешены только файлы JPG, JPEG, PNG и GIF.";
                $uploadOk = 0;
            }
     
            // Если все проверки пройдены, загружаем файл
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    return $targetFile;
                }
            }
        }
        return null;
    }

    // Добавляет новый товар в таблицу
    public static function add(mysqli $connection, Product $product) {
        $id = $product->getId();
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $stockQuantity = $product->getStockQuantity();
        $brandId = $product->getBrandId();
        $image = $product->getImage($connection, $product->getImageName());
        $sql = "INSERT INTO product VALUES ($id, '$name', '$description', $price, $stockQuantity, $brandId, $image);";
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
        //$image = $product->getImage($connection, $product->getImageName());
        $sql = "UPDATE product SET name = '$name', description = '$description', price = '$price', stock_quantity = $stockQuantity, brand_id = $brandId WHERE id = $id;";
        $connection->query($sql);
    }

    // Получает данные из таблицы
    public static function getData(mysqli $connection): array {
        $sql = "SELECT * FROM product";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }
}