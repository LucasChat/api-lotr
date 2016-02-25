<?php
/**
 * Created by PhpStorm.
 * User: jean_lyw
 * Date: 25/02/2016
 * Time: 17:17
 */

namespace LotrBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class EventToDateTest
 * @package LotrBundle\Tests\Service
 */
class EventToDateTest extends WebTestCase
{
	/**
	 * @var
	 */
	private $em;
	/**
	 * @var \Symfony\Bundle\FrameworkBundle\Client
	 */
	private $client;
	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerInterface
	 */
	private $container;

	/**
	 * EventToDateTest constructor.
	 */
	public function __construct()
	{
		$this->client = static::createClient();
		$this->container = $this->client->getContainer();
		$this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
	}

	public function testTransform()
	{
		$this->assertEquals(
				'2016-02-26',
				$this->container->get('event_to_date')->transform('2016-02-26', $this->em)
		);

		$this->assertEquals(
				"3019-03-25",
				$this->container->get('event_to_date')->transform('mort-de-gollum', $this->em)->format('Y-m-d')
		);
	}
}