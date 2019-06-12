<?php

namespace SchedulingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TimeOffControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/timeoff');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/timeoff/create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/timeoff/delete');
    }

    public function testApprove()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/timeoff/review');
    }

}
