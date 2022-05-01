<?php

declare(strict_types=1);

namespace Infrastructure\Core\Router;

final class ControllerFactory
{

    public static function build(Route $route): array
    {
        [$controller, $action] = explode("@", $route->handler);
        $fullControllerName = 'Application\Controllers\\' . $controller;
        $controllerInstance = new($fullControllerName);

        return [
            $controllerInstance,
            $action,
        ];
    }
}