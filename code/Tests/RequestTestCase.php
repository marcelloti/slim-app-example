<?php

namespace Tests;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

class RequestTestCase extends TestCase
{
    protected $withMiddleware = true;

    public function request(string $requestMethod, string $requestUri, $requestData = null)
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        $request = Request::createFromEnvironment($environment);

        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        $response = new Response();

        $app = require __DIR__ . '/../bootstrap.php';

        $response = $app->process($request, $response);

        return $response;
    }
}
