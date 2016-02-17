<?php

namespace LotrBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RacesControllerTest extends WebTestCase
{
    public function testShowraces()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showRaces');
    }

}
