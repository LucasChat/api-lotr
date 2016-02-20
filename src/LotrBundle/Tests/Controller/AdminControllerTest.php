<?php

namespace LotrBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testShowall()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showAll');
    }

}
