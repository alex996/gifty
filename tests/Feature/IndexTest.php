<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Client;
//use Tests\AppTestCase;
//use Symfony\Component\HttpFoundation\Request;

class IndexTest extends TestCase
{
    public function test()
    {
        $client = new Client();
        $response = $client->request('GET', '/welcome/alex');
        die($response);
        // $response = $this->app->handle(Request::create('/welcome/alex'));
        //
        // $this->assertEquals(200, $response->getStatusCode());
        // $this->assertContains('Hello alex', $response->getContent());
    }
}
