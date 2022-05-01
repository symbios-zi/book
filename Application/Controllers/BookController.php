<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\Book;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response,
};

use Infrastructure\Core\{
    View\View,
    Http\HtmlResponseFactory,
};

class BookController extends BaseController
{
    /**
     * @throws \Exception
     */
    public function show(Request $request): Response
    {
        $books = (new Book())->all();

        $render = (new View())
            ->withName("books/list")
            ->withData(['books' => $books]);

        return (new HtmlResponseFactory())
            ->createResponse(200)
            ->withContent($render);
    }

    /**
     * @throws \Exception
     */
    public function list(): Response
    {
        $books = (new Book())->all();

        $render = (new View())
            ->withName("books/list")
            ->withData(['books' => $books]);

        return (new HtmlResponseFactory())
            ->createResponse(200)
            ->withContent($render);
    }

    public function add(): Response
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }
}
