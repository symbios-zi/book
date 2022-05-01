<?php

declare(strict_types=1);

namespace Infrastructure\Core\Router;

use Infrastructure\Core\Http\Request;
use Infrastructure\Core\Http\RequestFactory;
use Psr\Http\Message\ResponseInterface;

final class Router
{

    // @TODO, перенести во внешний конфиг.
    private array $routes = [
        [
            "method" => "GET",
            "uri" => "/books/{id}",
            "action" => "BookController@show"
        ],
        [
            "method" => "POST",
            "uri" => "/scan",
            "action" => "BookController@add"
        ],
//        [
//            "method" => "GET",
//            "uri" => "/books",
//            "action" => "BookController@list"
//        ],

        [
            "method" => "POST",
            "uri" => "/books",
            "action" => "BookController@store"
        ],
        [
            "method" => "DELETE",
            "uri" => "/books/{id}",
            "action" => "BookController@delete"
        ],


        [
            "method" => "GET",
            "uri" => "/authors",
            "action" => "AuthorController@list"
        ]
    ];

    public function route(): ResponseInterface
    {
        $requestFactory = new RequestFactory();

        $request = $requestFactory->createRequest(
            $_SERVER["REQUEST_METHOD"],
            $_SERVER["REQUEST_URI"],
        );

        // ищем по регуляке нужный роут из списка
        // /books/{id} = /books/12
        $route = $this->getRoute($request)[0];

        if (empty($route)) {
            $this->abort(404);
        }

        // /books/{id} = /books/12
        // извлекаем динамические параметры роута {id} - 12
        // и добавляем уже к существующему Request
        $this->appendRouteParametersToRequest($request, $route);

        // Запускаем из найденного нами роута его контроллер и action, передавая туда наш Request
        return $this->runAction($request, $route);
    }

    private function getRoute(Request $request): array
    {
        return array_filter($this->routes, function (array $route) use ($request) {
            $expression = (new Expression())->build($route["uri"]);

            return $request->method === $route["method"] && preg_match($expression, $request->uri);
        });
    }


    private function appendRouteParametersToRequest(Request $request, mixed $route): void
    {
        (new RouteParametersExtractor())->extract($request, $route);
    }


    private function runAction(Request $request, array $route): ResponseInterface
    {
        [$controller, $action] = ControllerFactory::build($route);

        if ( ! method_exists($controller, $action)) {
            $this->abort(404);
        }

        return $controller->$action($request);
    }

    private function abort(int $code): void
    {
        http_response_code($code);
        die;
    }
}
