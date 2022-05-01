<?php

declare(strict_types=1);


use Infrastructure\Core\Router\Route;

return [

    /*
     * BOOKS
     */
    new Route("GET", "/books/{id}", "BookController@show"),
//    new Route("GET", "/books", "BookController@list"),
    new Route("POST", "/scan", "BookController@store"),
    new Route("POST", "/books", "BookController@store"),
    new Route("DELETE", "/books/{id}", "BookController@delete"),
    new Route("PUT", "/books/{id}", "BookController@update"),

    new Route("GET", "/books/search", "BookSearchController@find"),


    /*
     * BOOKS
     */
    new Route("GET", "/authors", "AuthorController@list"),
    new Route("GET", "/authors/top100", "AuthorController@top100")
];