<?php

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\EventListener\{
    ExceptionListener, ResponseListener, RouterListener
};
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\{ArgumentResolver, ControllerResolver};

$container = new ContainerBuilder;

$container->register('context', RequestContext::class);
$container->register('matcher', UrlMatcher::class)
    ->setArguments([
        '%routes%', new Reference('context')
    ]);
$container->register('request_stack', RequestStack::class);
$container->register('controller_resolver', ControllerResolver::class);
$container->register('argument_resolver', ArgumentResolver::class);

$container->register('listener.router', RouterListener::class)
    ->setArguments([
        new Reference('matcher'), new Reference('request_stack')
    ]);
$container->register('listener.response', ResponseListener::class)
    ->setArguments(['UTF-8']);
$container->register('listener.exception', ExceptionListener::class)
    ->setArguments([
        'App\Controllers\ErrorController::exceptionAction'
    ]);

$container->register('dispatcher', EventDispatcher::class)
    ->addMethodCall('addSubscriber', [new Reference('listener.router')])
    ->addMethodCall('addSubscriber', [new Reference('listener.response')])
    ->addMethodCall('addSubscriber', [new Reference('listener.exception')]);

$container->register('kernel', HttpKernel::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('controller_resolver'),
        new Reference('request_stack'),
        new Reference('argument_resolver')
    ]);

return $container;
