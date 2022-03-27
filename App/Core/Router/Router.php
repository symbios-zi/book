<?php

namespace App\Core\Router;

use ReflectionClass;

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
        //  извлекаем нужные данные запроса из глобальной переменной $_SERVER
        [
            "REQUEST_METHOD" => $method,
            "REQUEST_URI" => $uri,
            "QUERY_STRING" => $query,
        ] = $this->serverArgs;

        // Запрашиваемый роут и метод
        $needleRoute = [
            "method" => $method,
            "uri" => $uri
        ];

        // Ищем этот роут среди списка наших
        $route = array_filter($this->routes, function(array $route) use ($needleRoute) {
            return
                $needleRoute["method"] === $route["method"] &&
                $needleRoute["uri"] === $route["uri"];
        });

        // @TODO если роут не найден, вернуть ответ 404

        // Извлекаем класс контроллера для этого роута и его action
        [$controller, $action] = explode("@", $route[0]["action"]);


        // создаем экземпляр контроллера
        $controllerInstance = new('App\Controllers\\' . $controller);

        // вызываем action (метод) из контроллера.
        $controllerInstance->$action();

        /*
        * Пример. BookController@list будет выполнен как
        *  $controller = new BookController();
        *  $controller->list();
        */



        // Если идет обращение к адресу, которого нет в списке наших, мы обязаны выдать ошибку 404

    }
}