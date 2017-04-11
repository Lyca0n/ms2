<?php

namespace CallcenterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SegmentControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/segment');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/segment/delete/{id}');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/segment/edit/{id}');
    }

}
