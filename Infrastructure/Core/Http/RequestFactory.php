<?php

namespace Infrastructure\Core\Http;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestFactory implements RequestFactoryInterface
{

    public function createRequest(string $method, $uri): RequestInterface
    {

        return new Request(
            $_SERVER["REQUEST_METHOD"],
            $_SERVER["REQUEST_URI"],
            $_SERVER["QUERY_STRING"],
        );
    }
}