<?php

require_once './vendor/autoload.php';


use App\Core\Router\Router;



$router = new Router();

$router->route();

var_dump($router); die;

