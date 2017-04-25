<?php

namespace TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticket');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticket/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticket/edit');
    }

    public function testClose()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticket/close');
    }

}
