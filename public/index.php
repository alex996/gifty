<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\EventListener\{
    ExceptionListener, ResponseListener, RouterListener
};
use Symfony\Component\HttpFoundation\{Request, RequestStack};
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};


$request = Request::createFromGlobals();
$requestStack = new RequestStack;
$routes = require_once __DIR__.'/../app/routes.php';

$context = new RequestContext;
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver;
$argumentResolver = new ArgumentResolver;

$dispatcher = new EventDispatcher;
$dispatcher->addSubscriber(new RouterListener($matcher, $requestStack));
$dispatcher->addSubscriber(new ResponseListener('UTF-8'));
$dispatcher->addSubscriber(new ExceptionListener(
    'App\Controllers\ErrorController::exceptionAction'
));
//$dispatcher->addSubscriber(new ContentLengthListener);
//$dispatcher->addSubscriber(new GoogleListener);

$kernel = new HttpKernel($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
$response = $kernel->handle($request);
$response->send();
