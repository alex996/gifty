<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\{ControllerResolver, ArgumentResolver};

$request = Request::createFromGlobals();
$routes = require_once __DIR__.'/../app/routes.php';

$context = new RequestContext;
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver;
$argumentResolver = new ArgumentResolver;

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
}
catch (ResourceNotFoundException $e) {
    $response = new Response('Not Found', 400);
}
catch(Exception $e) {
    die($e);
    $response = new Response('Internal Server Error', 500);
}

$response->prepare($request);
$response->send();
