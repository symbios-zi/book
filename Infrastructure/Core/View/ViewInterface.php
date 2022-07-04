<?php

declare(strict_types=1);


namespace Infrastructure\Core\View;

interface ViewInterface
{
    public function render($template, $data): mixed;
}