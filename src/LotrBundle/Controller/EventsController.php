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

	public function getEventPositionCharactersAction($slug)
	{
		$em = $this->getDoctrine()->getManager();

		$event = $em->getRepository('LotrBundle:Events')->findBySlug($slug);
		if(!$event)
		{
			throw new NotFoundHttpException("Event not found");
		}

		$trip = $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByPeriodForAll($event[0]->getDate(), $event[0]->getDateEnd());

		$results = [];
		array_push($results, $event, $trip);
		$view = $this->view($results);
		return $this->handleView($view);
	}

	public function getEventPresentCharactersAction($slug)
	{
		$em = $this->getDoctrine()->getManager();

		$event = $em->getRepository('LotrBundle:Events')->findBySlug($slug);
		if(!$event)
		{
			throw new NotFoundHttpException("Event not found");
		}

		$trip = $em->getRepository('LotrBundle:CharactersTrip')
				->getCharactersTripByPeriodAndPresenceForAll($event[0]->getDate(), $event[0]->getDateEnd(), $event[0]->getCoordx(), $event[0]->getCoordy());

		$results = [];
		array_push($results, $event, $trip);
		$view = $this->view($results);
		return $this->handleView($view);
	}
}
