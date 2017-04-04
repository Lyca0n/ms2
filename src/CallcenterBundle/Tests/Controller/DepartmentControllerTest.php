<?php

namespace CallcenterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepartmentControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/department');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/department/delete/{id}');
    }

}
