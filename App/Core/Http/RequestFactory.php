<?php

namespace App\Core\Http;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestFactory implements RequestFactoryInterface
{

    public function createRequest(string $method, $uri): RequestInterface
    {
        // TODO: Implement createRequest() method.
    }
}