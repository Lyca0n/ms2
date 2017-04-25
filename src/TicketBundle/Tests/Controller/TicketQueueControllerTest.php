<?php

namespace TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketQueueControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketqueue');
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketqueue/create');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketqueue/create');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketqueue/delete/{id}');
    }

}
