<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\{Request, Response};

function renderTemplate(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include_once sprintf(__DIR__.'/../views/%s.php', $_route);

    return new Response(ob_get_clean());
}

$routes = new RouteCollection;

$routes->add('welcome', new Route('/welcome/{name}', [
    'name' => 'World',
    '_controller' => function(Request $request) {
        return renderTemplate($request);
    }
]));

$routes->add('leap_year', new Route('/leap-year/{year}', [
    '_controller' => 'App\Controllers\LeapYearController::indexAction'
]));

return $routes;
