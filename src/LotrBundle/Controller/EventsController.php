<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EventsController extends FOSRestController
{
	public function getEventsAction()
	{
		$em = $this->getDoctrine()->getManager();

		$events = $em->getRepository('LotrBundle:Events')->findAll();

		$view = $this->view($events);
		return $this->handleView($view);
	}
}
