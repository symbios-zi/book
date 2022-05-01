<?php

namespace Application\Models;

use PDO;

/**
 * Базовая модель (entity), от нее будут наследоваться все модели.
 * Отвечает за создание соединия с базой данных и предоставления подключения моделям.
 */
abstract class Model
{
    private string $host = 'book-mysql';
    private string $user = 'book_login';
    private string $password = 'book_password';
    private string $database = 'book';
    private string $charset = "utf8";
    private array $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    protected PDO $connection;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database;charset=$this->charset";

        $this->connection = new PDO($dsn, $this->user, $this->password, $this->options);
    }
}
