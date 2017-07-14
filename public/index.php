<?php

require_once __DIR__.'/../vendor/autoload.php';

use Gifty\Framework\App;
use Gifty\Framework\Listeners\GoogleListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Gifty\Framework\Listeners\ContentLengthListener;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

$request = Request::createFromGlobals();
$routes = require_once __DIR__.'/../app/routes.php';

$dispatcher = new EventDispatcher;
//$dispatcher->addSubscriber(new ContentLengthListener);
//$dispatcher->addSubscriber(new GoogleListener);

$context = new RequestContext;
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver;
$argumentResolver = new ArgumentResolver;

$app = new App($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$response = $app->handle($request);

$response->prepare($request);
$response->send();
