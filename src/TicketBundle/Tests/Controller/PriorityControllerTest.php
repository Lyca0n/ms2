<?php

namespace TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PriorityControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketpriority');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketpriority/edit/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketpriority/delete/{id}');
    }

}
