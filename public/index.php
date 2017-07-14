<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$container = require_once __DIR__.'/../bootstrap/container.php';
$container->setParameter('routes', require_once __DIR__.'/../app/routes.php');

$kernel = $container->get('kernel');

$response = $kernel->handle(
    $request = Request::createFromGlobals()
);

$response->send();

$kernel->terminate($request, $response);
