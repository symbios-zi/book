<?php

namespace App\Controllers;

use App\Core\Http\HTMLResponse;
use App\Core\View\View;
use App\Models\Book;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends BaseController
{

    public function show(Request $request)
    {
        $books = (new Book())->all();
        $template = (new View());

        $template->withName("books/list");
        $template->withData(['books' => $books]);

        $response = new HTMLResponse();

        $response->setData($template->render());

        return $response;
    }

    public function list(): Response
    {
        $books = (new Book())->all();
        $template = (new View());

        $template->withName("books/list");
        $template->withData(['books' => $books]);

        $response = new HTMLResponse();

        $response->setData($template->render());

        return $response;
    }

    public function add()
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }

}