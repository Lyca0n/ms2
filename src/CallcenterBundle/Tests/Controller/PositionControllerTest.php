<?php

namespace CallcenterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PositionControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/position');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/position/create');
    }

}
