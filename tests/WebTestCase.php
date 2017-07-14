<?php

/*
 * This file is inspired by Symfony\Bundle\FrameworkBundle\Test\WebTestCase.
 * 
 * For the original Symfony package implementation, please visit the link:
 * github.com/symfony/framework-bundle/blob/master/Test/WebTestCase.php
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Client;

abstract class WebTestCase extends TestCase
{
    protected static $client;

    protected static function createClient()
    {
        if (static::$client === null)
        {
            $container = require_once __DIR__.'/../bootstrap/container.php';
            $container->setParameter('routes', require_once __DIR__.'/../app/routes.php');

            static::$client = new Client($container->get('kernel'));
        }

        return static::$client;
    }
}
