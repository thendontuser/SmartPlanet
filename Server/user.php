<?php

// Класс для работы с таблицей users
class User {

    // Номер пользователя
    private $phoneNumber;

    // Пароль
    private $password;

    // Логин
    private $username;

    // Конструктор. Инициализирует поля класса
    public function __construct(string $phoneNumber, string $password, string $username) {
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->username = $username;
    }

    // возвращает номер пользователя
    public function getPhoneNumber(): string {
        return $this->phoneNumber;
    }

    // возвращает пароль пользователя
    public function getPassword(): string {
        return $this->password;
    }

    // возвращает логин пользователя
    public function getUsername(): string {
        return $this->username;
    }

    // Добавляет нового пользователя в таблицу
    public static function add(mysqli $connection, User $user) {
        $phone = $user->getPhoneNumber();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $username = $user->getUsername();
        $sql = "INSERT INTO user (phone_number, password, username) VALUES ('$phone', '$password', '$username');";
        $connection->query($sql);
    }

    // Удаляет пользователя из таблицы
    public static function delete(mysqli $connection, int $id) {
        $sql = "DELETE FROM user WHERE id = $id";
        $connection->query($sql);
    }

    // Обновляет запись
    public static function update(mysqli $connection, User $user) {
        $phone = $user->getPhoneNumber();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $sql = "UPDATE user SET phone_number = '$phone', password = '$password');";
        $connection->query($sql);
    }

    // Получает данные из таблицы
    public static function getData(mysqli $connection): array {
        $sql = "SELECT * FROM user";
        $data = $connection->query($sql);
        return $data->fetch_all(MYSQLI_NUM);
    }

    // Проверяет, существует ли пользоваетль $user в системе. Метод определяет результат по username
    public static function isExists(mysqli $connection, string $username): bool {
        $users = User::getData($connection);

        for ($i = 0; $i < count($users); $i++) {
            if (strcmp($users[$i][3], $username) == 0) {
                return true;
            }
        }
        return false;
    }
}