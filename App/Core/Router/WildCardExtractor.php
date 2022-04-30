<?php

namespace App\Core\Router;

class WildCardExtractor
{

    public function get(string $uri): array|null
    {
        preg_match_all("/\{(\w+)\}/", $uri, $wildCardsList, PREG_PATTERN_ORDER);

        array_shift($wildCardsList);

        return $wildCardsList[0];
    }
}