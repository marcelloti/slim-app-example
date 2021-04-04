<?php

namespace SlimExample\Modules\Core\Middlewares;

class CorsMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response, $next);
        $response->withHeader('Access-Control-Allow-Origin', '*')
                 ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization, Origin, Accept')
                 ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        return $response;
    }
}