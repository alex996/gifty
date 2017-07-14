<?php

namespace Tests\Feature;

use Tests\WebTestCase;

class IndexTest extends WebTestCase
{
    public function test()
    {
        $client = static::createClient();
        $client->request('GET', '/welcome/alex');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
