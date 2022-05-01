<?php

declare(strict_types=1);

namespace Application\Controllers;

use Application\Models\Book;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\{ResponseFactoryInterface, ServerRequestInterface as Request, ResponseInterface as Response};

use Infrastructure\Core\{
    View\View,
    Http\HtmlResponseFactory
};

class BookController extends BaseController
{
    private View $view;
    private ResponseFactoryInterface $htmlResponseFactory;

    public function __construct(ContainerInterface $container)
    {
         $this->view = $container->get(View::class);
         $this->htmlResponseFactory = $container->get(HtmlResponseFactory::class);
    }

    /**
     * @throws \Exception
     */
    public function show(Request $request): Response
    {
        $books = (new Book())->all();

        $render = (new View())
            ->withName("books/list")
            ->withData(['books' => $books]);

        return $this->htmlResponseFactory
            ->createResponse(200)
            ->withContent($render);
    }

    /**
     * @throws \Exception
     */
    public function list(): Response
    {
        $books = (new Book())->all();

        $render = $this->view
            ->withName("books/list")
            ->withData(['books' => $books]);

        return $this->htmlResponseFactory
            ->createResponse(200)
            ->withContent($render);
    }

    public function add(): Response
    {
        $attributes = $_REQUEST;

        (new Book())->add($attributes);
    }
}
