<?php

namespace App\Controllers;

use App\Models\Book;

class BookController extends BaseController
{

    public function list()
    {
        $books = (new Book())->all();

        return $this->render('books/list.php', compact('books'));
    }

    public function add()
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }

}