<?php

require_once __DIR__.'/../vendor/autoload.php';


use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$request = Request::createFromGlobals();
$routes = require_once __DIR__.'/../app/routes.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    ob_start();
    include_once sprintf(__DIR__.'/../views/%s.php', $_route);

    $response = new Response(ob_get_clean());
}
catch (ResourceNotFoundException $e) {
    $response = new Response('Not Found', 400);
}
catch(Exception $e) {
    $response = new Response('Internal Server Error', 500);
}

$response->prepare($request);
$response->send();
