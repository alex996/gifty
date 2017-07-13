<?php

namespace Tests\Feature;

use Tests\AppTestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexTest extends AppTestCase
{
    public function test()
    {
        $response = $this->app->handle(Request::create('/welcome/alex'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello alex', $response->getContent());
    }
}
