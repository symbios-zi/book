<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response,
};

use App\Models\Book;
use App\Core\View\View;
use App\Core\Http\HtmlResponseFactory;

class BookController extends BaseController
{

    /**
     * @throws \Exception
     */
    public function show(Request $request): Response
    {
        $books = (new Book())->all();
        $render = (new View());

        $render->withName("books/list");
        $render->withData(['books' => $books]);

        $responseFactory = new HtmlResponseFactory();
        $response = $responseFactory->createResponse(200 );
        return $response->withContent($render);
    }

    /**
     * @throws \Exception
     */
    public function list(): Response
    {
        $books = (new Book())->all();
        $render = (new View());

        $render->withName("books/list");
        $render->withData(['books' => $books]);

        $responseFactory = new HtmlResponseFactory();
        $response = $responseFactory->createResponse(200 );
        return $response->withContent($render);
    }

    public function add(): Response
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }

}