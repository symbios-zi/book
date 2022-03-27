<?php
// включаем автозагрузку классов. Нам не нужно указывать require в классах
require_once './vendor/autoload.php';


use App\Core\Router\Router;

$router = new Router();

$router->route();

