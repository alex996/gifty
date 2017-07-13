<?php

namespace Tests;

use Gifty\Framework\App;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

abstract class AppTestCase extends TestCase
{
    protected $app;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        if (! $this->app) {
            $this->createApplication();
        }

        parent::setUp();
    }

    /**
     * Create an application based on the routes file.
     *
     * @return void
     */
    protected function createApplication()
    {
        $routes = require_once __DIR__.'/../app/routes.php';

        $this->app = new App(
            new UrlMatcher($routes, new RequestContext),
            new ControllerResolver,
            new ArgumentResolver
        );
    }
}
