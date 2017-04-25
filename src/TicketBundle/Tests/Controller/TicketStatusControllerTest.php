<?php

namespace TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketStatusControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketstatus');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketstatus/edit/{id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticketstatus/delete/{id}');
    }

}
