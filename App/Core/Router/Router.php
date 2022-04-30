<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Request;

final class Router
{

    private array $serverArgs;

    public function __construct()
    {
         $this->serverArgs = $_SERVER;
    }

    private array $routes = [
        [
            "method" => "GET",
            "uri" => "/books/{id}/list/{code}",
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

    public function route()
    {
        $request = new Request(
            $this->serverArgs["REQUEST_METHOD"],
            $this->serverArgs["REQUEST_URI"],
            $this->serverArgs["QUERY_STRING"],
        );

        $route = $this->getRoute($request)[0];

        if (empty($route)) {
            $this->abort(404);
        }

        $this->appendRouteParametersToRequest($request, $route);
        $this->runAction($request, $route);

        $this->abort(404);
    }

    private function getRoute(Request $request): array
    {
        return array_filter($this->routes, function (array $route) use ($request) {
            $expression = (new Expression())->build($route["uri"]);

            return $request->method === $route["method"] && preg_match($expression, $request->uri);
        });
    }

    private function abort(int $code): void
    {
        http_response_code($code);
        die;
    }

    private function appendRouteParametersToRequest(Request $request, mixed $route): void
    {
        (new RouteParametersExtractor())->extract($request, $route);
    }


    private function runAction(Request $request, array $route): void
    {
        [$controller, $action] = ControllerFactory::build($route);


        if (method_exists($controller, $action)) {
            $controller->$action($request);
        }
    }
}