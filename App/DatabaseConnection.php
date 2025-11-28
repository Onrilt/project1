<?php

namespace App;

use PDO;

class DatabaseConnection
{
    private static $instance = null;
    private $connection;

    // Приватный конструктор запрещает создание через new
    private function __construct()
    {
        // Инициализация соединения с БД
        $this->connection = new PDO(
            'mysql:host=' . Config::get('database.host') . ';dbname=' . Config::get('database.database'),
            Config::get('database.user'),
            Config::get('database.password')
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Запрещаем клонирование
    private function __clone() {}

    // Запрещаем десериализацию
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    // Единственный способ получить экземпляр
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Метод для получения соединения
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // Пример бизнес-логики
    public function query(string $sql): array
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}