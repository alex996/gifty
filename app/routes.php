<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('welcome', new Route('/welcome/{name}', ['name' => 'World']));
//$routes->add('bye', new Route('/bye'));

return $routes;
