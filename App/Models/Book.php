<?php

namespace App\Models;

/**
 * Класс книги.
 * Все данные о книгах из базы берем через этот класс
 */
class Book extends Model
{
    private string $table = "books";


    public function all(): array
    {
        $sql = "SELECT * FROM {$this->table}";

        $stmt = $this->connection->query($sql);

        return $stmt->fetchAll();
    }

    public function search($name): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE name like %:name%";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['name' => $name]);

        return $stmt->fetchAll();
    }

    public function byYear($from, $to): array
    {
        $sql = "SELECT * FROM {$this->table} WHERE year >= :from and year <= :to";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['from' => $from, 'to' => $to]);

        return $stmt->fetchAll();
    }

    public function add(array $attributes)
    {
        //@TODO Добавлнение в базу новой книги
    }


}