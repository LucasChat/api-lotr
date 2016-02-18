<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventsController extends FOSRestController
{
	public function getEventsAction()
	{
		$em = $this->getDoctrine()->getManager();

		$events = $em->getRepository('LotrBundle:Events')->findAll();

		$view = $this->view($events);
		return $this->handleView($view);
	}

	public function getEventAction($slug)
	{
		$em = $this->getDoctrine()->getManager();

		$event = $em->getRepository('LotrBundle:Events')->findBySlug($slug);
		
		if(!$event)
		{
			throw new NotFoundHttpException("Event not found");
		}

		$view = $this->view($event);
		return $this->handleView($view);
	}
}
