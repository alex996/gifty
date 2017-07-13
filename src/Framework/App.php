<?php

namespace Gifty\Framework;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class App
{
    protected $matcher;

    protected $controllerResolver;

    protected $argumentResolver;

    public function __construct(
        UrlMatcher $matcher,
        ControllerResolver $controllerResolver,
        ArgumentResolver $argumentResolver
    ) {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add(
                $this->matcher->match($request->getPathInfo())
            );

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        }
        catch (ResourceNotFoundException $e) {
            return new Response('Not Found', 400);
        }
        catch(Exception $e) {
            return new Response('Internal Server Error', 500);
        }
    }
}
