<?php

namespace SlimExample\Modules\Core\Middlewares;
use SlimExample\Modules\Authentication\Services\LoginService;

class AuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $rota = $request->getUri()->getPath();

        preg_match('/(\/api\/(?!login))/', $rota, $matches, PREG_OFFSET_CAPTURE);
        $protectedRoute = count($matches) === 0 ? false : true;

        if (!$protectedRoute){
            $response = $next($request, $response, $next);
            return $response;
        }

        $headers = $request->getHeaders();
        if (!isset($headers['HTTP_AUTHORIZATION'])){
            return $response->withStatus(401);
        }

        $tokenHeader = $headers['HTTP_AUTHORIZATION'];
        $tokenExploded = explode("Bearer ", $tokenHeader[0]);

        if (count($tokenExploded) !== 2){
            return $response->withStatus(401);
        }

        $tokenValue = $tokenExploded[1];

        $validToken = LoginService::validateAuthToken($tokenValue);

        if (!$validToken){
            return $response->withStatus(401);
        }
    }
}