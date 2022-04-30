<?php

declare(strict_types=1);

namespace App\Core\Http;


class HTMLResponse extends Response
{

    public function setData(string $data): void
    {
        $stream = (new HTMLStream());
        $stream->write($data);

        $this->withBody($stream);
    }
}