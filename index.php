<?php


/**
 * Это входная точка приложения, какой бы относительный путь не выбрал, все равно попадем сюда.
 * Так настроен nginx
 */

// включаем автозагрузку классов. Нам не нужно указывать require в классах
require_once './vendor/autoload.php';

use Infrastructure\Core\Router\Router;


/**
 * Мы создали небольшой роутер, который будет маршрутизировать все запросы на нужные контроллеры.
 *  - Для книг адрес books.local/books
 *  - Для авторов адрес books.local/authors
 *  - Для создания нового роута: добавляем в роутере новый роут и создаем для него контроллер и экшен.
 */

$response = (new Router())
    ->withRoutes(include 'Application/Config/routes/web.php')
    ->route();

// Step 1: Генерируем строку статуса.
$statusLine = sprintf('HTTP/%s %s %s'
    , $response->getProtocolVersion()
    , $response->getStatusCode()
    , $response->getReasonPhrase()
);

// Step 2: переопределяем хеадер, даже если он был.
header($statusLine, TRUE);


// Step 3: Устанавливаем кастомные хедеры
if ($response->getHeaders()) {
    foreach ($response->getHeaders() as $name => $values) {
        $responseHeader = sprintf('%s: %s'
            , $name
            , $response->getHeaderLine($name)
        );
        header($responseHeader, FALSE); /* The header doesn't replace a previous similar header. */
    }

}

// Step 4: Возвращаем ответ
echo $response->getBody();

exit();

// dispatch response

