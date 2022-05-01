<?php

declare(strict_types=1);

namespace App\Core\Http;


use App\Core\View\View;

class HtmlResponse extends Response
{

    /**
     * @throws \Exception
     */
    public function withContent(View $render): static
    {
        $stream = (new HTMLStream());
        $stream->write($render());

        $this->withBody($stream);

        return $this;
    }
}