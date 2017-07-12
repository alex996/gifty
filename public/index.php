<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();

$map = [
    '/hello' => 'hello',
    '/bye' => 'bye'
];

$path = $request->getPathInfo();
if (isset($map[$path])) {
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include_once sprintf(__DIR__.'/../views/%s.php', $map[$path]);
    $response = new Response(ob_get_clean());
}
else {
    $response = new Response('Not Found', 400);
}

$response->prepare($request);
$response->send();


//die(nl2br($request));
