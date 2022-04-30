<?php

declare(strict_types=1);

namespace App\Core\Router;

final class ControllerFactory
{

    public static function build($route): array
    {
        [$controller, $action] = explode("@", $route["action"]);
        $fullControllerName = 'App\Controllers\\' . $controller;
        $controllerInstance = new($fullControllerName);

        return [
            $controllerInstance,
            $action,
        ];
    }
}