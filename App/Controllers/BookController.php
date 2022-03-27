<?php

namespace App\Controllers;

use App\Models\Book;

class BookController extends Controller
{

    public function list()
    {
        $books = (new Book())->all();

        dd($books);

        // @TODO реализуем простой шаблонизатор, с передачей данных
        $this->render('books/list.php', compact('books'));
    }

    public function add()
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }

}