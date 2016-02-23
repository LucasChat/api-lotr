<?php

namespace LotrBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testShowall()
    {
        $client = static::createClient();

        $client->request('GET', '/admin/');

        $this->assertContains('text/html', $client->getResponse()->headers->get('content-type'));
    }

// This test works but crash the testGetEvents in EventsControllerTest.php
//    public function testAddEvent()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/admin/new/event');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/new/event");
//
//        $form = $crawler->selectButton('Create event')->form(array(
//            'form[slug]'  => 'test',
//            'form[name]'  => 'Test',
//            'form[date]'  => '1994-02-01',
//            'form[dateEnd]'  => '1994-02-13',
//            'form[coordX]'  => 42,
//            'form[coordY]'  => 42,
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        $client->request('GET', '/event/test');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /event/test");
//    }

// This test works but crash the testGetPlaces in PlacesControllerTest.php
//    public function testAddPlace()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/admin/new/place');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/new/place");
//
//        $form = $crawler->selectButton('Create place')->form(array(
//            'form[slug]'  => 'test',
//            'form[name]'  => 'Test',
//            'form[coordX]'  => 42,
//            'form[coordY]'  => 42,
//        ));
//
//        $client->submit($form);
//        $crawler = $client->followRedirect();
//
//        $client->request('GET', '/place/test');
//        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /place/test");
//    }
}
