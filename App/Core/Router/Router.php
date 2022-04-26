<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Request;

class Router
{

    private array $serverArgs;

    public function __construct()
    {
         $this->serverArgs = $_SERVER;
    }

    private array $routes = [
        [
            "method" => "GET",
            "uri" => "/scan",
            "action" => "BookController@add"
        ],
        [
            "method" => "GET",
            "uri" => "/books",
            "action" => "BookController@list"
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

        $route = $this->getRoute($request);

        if (empty($route)) {
            $this->abort();
        }

        $route = reset($route);

        [$controller, $action] = explode("@", $route["action"]);

        $fullControllerName = 'App\Controllers\\' . $controller;



        $controllerInstance = new($fullControllerName);

        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action($request);
        }

        $this->abort();

        // вызываем action (метод) из контроллера.
    }

    private function getRoute(Request $request): array
    {
        return array_filter($this->routes, function (array $route) use ($request) {
            return
                $request->method === $route["method"] &&
                $request->uri === $route["uri"];
        });
    }

    private function abort(int $code = 404): void
    {
        http_response_code($code);
        die;
    }
}