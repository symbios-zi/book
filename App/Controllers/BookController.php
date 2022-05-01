<?php

namespace App\Controllers;

use App\Core\Http\HtmlResponse;
use App\Core\View\View;
use App\Models\Book;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookController extends BaseController
{

    /**
     * @throws \Exception
     */
    public function show(Request $request): ResponseInterface
    {
        $books = (new Book())->all();
        $render = (new View());

        $render->withName("books/list");
        $render->withData(['books' => $books]);

        return (new HtmlResponse())
            ->withStatus(200)
            ->withContent($render);
    }

    public function list(): Response
    {
        $books = (new Book())->all();
        $template = (new View());

        $template->withName("books/list");
        $template->withData(['books' => $books]);

        $response = new HtmlResponse();

        $response->withContent($template->render());

        return $response;
    }

    public function add()
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }

}