<?php

namespace CallcenterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StakeHolderControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stakeholder');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stakeholder/create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stakeholder/delete/{id}');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stakeholder/edit/{id}');
    }

}
