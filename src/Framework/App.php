<?php

namespace Gifty\Framework;

use Exception;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class App
{
    protected $matcher;

    protected $controllerResolver;

    protected $argumentResolver;

    public function __construct(
        UrlMatcherInterface $matcher,
        ControllerResolverInterface $controllerResolver,
        ArgumentResolverInterface $argumentResolver
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
            return new Response('Not Found', 404);
        }
        catch(Exception $e) {
            return new Response('Internal Server Error', 500);
        }
    }
}
