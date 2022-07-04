<?php

declare(strict_types=1);


namespace Application\Models\Book;

use Infrastructure\Core\Repository\RepositoryInterface;

class MysqlBookRepository implements RepositoryInterface
{
    public function getById(): mixed
    {
        return "Hello World";
    }
}
