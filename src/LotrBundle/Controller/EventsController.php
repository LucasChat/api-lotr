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

		$date1 = $event[0]->getDate();
		$date2 = $date1->modify('+' . ($event[0]->getDuration()) - 1 . ' day');

		$charactes_position = $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByPeriodForAll($date1, $date2);

		$view = $this->view($charactes_position);
		return $this->handleView($view);
	}

	public function getEventPresentCharactersAction($slug)
	{
		$em = $this->getDoctrine()->getManager();

		$event = $em->getRepository('LotrBundle:Events')->findBySlug($slug);

		$date1 = $event[0]->getDate();
		$date2 = $date1->modify('+' . ($event[0]->getDuration()) - 1 . ' day');

		if(!$event)
		{
			throw new NotFoundHttpException("Event not found");
		}

		$charactes_position = $em->getRepository('LotrBundle:CharactersTrip')
				->getCharactersTripByPeriodAndPresenceForAll($date1, $date2, $event[0]->getCoordx(), $event[0]->getCoordy());

		$view = $this->view($charactes_position);
		return $this->handleView($view);
	}
}
