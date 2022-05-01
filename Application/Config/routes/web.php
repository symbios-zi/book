<?php

declare(strict_types=1);

return [
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