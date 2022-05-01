<?php

declare(strict_types=1);

namespace App\Core\Http;


final class HtmlResponseFactory extends ResponseFactory
{

    public function createResponse(int $code = 200, string $reasonPhrase = ''): HtmlResponse
    {
        return (new HtmlResponse())
            ->withStatus($code);
    }
}