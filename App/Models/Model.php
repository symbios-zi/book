<?php

namespace App\Models;

use PDO;

/**
 * Базовая модель (entity), от нее будут наследоваться все модели.
 * Отвечает за создание соединия с базой данных и предоставления подключения моделям.
 */
class Model
{

    private $host = 'localhost';
    private $user = 'root';
    private $password = 'misterpika20';
    private $db = 'books_bd';
    private $charset = "utf8";
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    protected $connection;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $this->connection = new PDO($dsn, $this->user, $this->password, $this->options);
    }
}
