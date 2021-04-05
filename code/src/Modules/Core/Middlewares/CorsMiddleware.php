<?php

namespace SlimExample\Modules\Core\Middlewares;

class CorsMiddleware
{
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, \Slim\App $next): \Slim\Http\Response
    {
        $response = $next($request, $response, $next);
        $response->withHeader('Access-Control-Allow-Origin', '*')
                 ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization, Origin, Accept')
                 ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

        return $response;
    }
}