<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
//die(nl2br($request));
$input = $request->get('name', 'World');

$response = new Response(
    sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8'))
);

$response->prepare($request);
$response->send();

// todos:
// 2. review this http://symfony.com/doc/current/introduction/from_flat_php_to_symfony2.html
// 3. continue here http://symfony.com/doc/current/create_framework/http_foundation.html
