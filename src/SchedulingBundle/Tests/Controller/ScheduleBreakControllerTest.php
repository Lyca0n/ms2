<?php

namespace SchedulingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScheduleBreakControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/break');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/break/create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/break/delete');
    }

}
