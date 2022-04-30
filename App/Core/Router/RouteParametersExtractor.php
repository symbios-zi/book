<?php

namespace App\Core\Router;

use App\Core\Request;

class RouteParametersExtractor
{
    public function extract(Request $request, array $route): void
    {
        $routeWildCards = (new WildCardExtractor())->get($route["uri"]);

        $expression = (new Expression())->build($route["uri"]);
        preg_match_all($expression, $request->uri, $routeParams, PREG_SET_ORDER);

        $matchedParams = $routeParams[0];
        array_shift($matchedParams);

        $request->setAttributes(array_combine($routeWildCards, $matchedParams));
    }
}