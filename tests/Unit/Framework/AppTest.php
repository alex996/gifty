<?php

namespace Tests\Unit\Framework;

use RuntimeException;
use Gifty\Framework\App;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class AppTest extends TestCase
{
    public function testNotFoundHandling()
    {
        $app = $this->getAppForException(new ResourceNotFoundException);

        $response = $app->handle(new Request);

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testErrorHandling()
    {
        $app = $this->getAppForException(new RuntimeException);

        $response = $app->handle(new Request);

        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testControllerResponse()
    {
        $app = $this->getAppForRoute([
            '_route' => 'welcome',
            'name' => 'Alex',
            '_controller' => function($name) {
                return new Response("Hello $name");
            }
        ]);

        $response = $app->handle(new Request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello Alex', $response->getContent());
    }

    protected function getAppForRoute($route)
    {
        return $this->getApp($this->returnValue($route));
    }

    protected function getAppForException($exception)
    {
        return $this->getApp($this->throwException($exception));
    }

    protected function getApp($matcherWill)
    {
        $matcher = $this->createMock(UrlMatcherInterface::class);

        $matcher->expects($this->once())
            ->method('match')
            ->will($matcherWill);

        $matcher->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->createMock(RequestContext::class)));

        $controllerResolver = new ControllerResolver;//$this->createMock(ControllerResolverInterface::class);
        $argumentResolver = new ArgumentResolver;//$this->createMock(ArgumentResolverInterface::class);

        return new App($matcher, $controllerResolver, $argumentResolver);
    }
}
