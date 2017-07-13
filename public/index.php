<?php

require_once __DIR__.'/../vendor/autoload.php';

use Gifty\Framework\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

$request = Request::createFromGlobals();
$routes = require_once __DIR__.'/../app/routes.php';

$context = new RequestContext;
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver;
$argumentResolver = new ArgumentResolver;

$app = new App($matcher, $controllerResolver, $argumentResolver);
$response = $app->handle($request);

$response->prepare($request);
$response->send();
