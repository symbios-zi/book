<?php

namespace App\Controllers;

use App\Models\Book;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends BaseController
{

    public function show(Request $request)
    {
        dd($request->getAttribute('code'));
    }

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