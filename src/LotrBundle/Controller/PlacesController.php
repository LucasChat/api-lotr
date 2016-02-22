<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use LotrBundle\LotrBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class PlacesController extends FOSRestController
{
    public function getPlacesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $places = $em->getRepository('LotrBundle:Places')->findAll();

        if($request->query->get('format') == 'png' && gettype($places) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), null, $places);
        }

        $view = $this->view($places);
        return $this->handleView($view);
    }


    public function getPlaceAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }

        if($request->query->get('format') == 'png' && gettype($place) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), null, $place);
        }

        $view = $this->view($place);
        return $this->handleView($view);
    }

    public function getPlaceAllCharactersAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

//        $place_test = $this->getPlaceAction($slug)->getContent(true);
//        $placeJson = $this->get('jms_serializer')->deserialize($place, 'LotrBundle\Entity\Places', 'json');

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }
        $characters_trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByCoordForAll($place[0]->getCoordx(), $place[0]->getCoordy());

        $results = [];
        array_push($results, $place, $characters_trip);

        $view = $this->view($results);
        return $this->handleView($view);
    }

    public function getPlaceAllCharactersByDateAction($slug, $date)
    {
        $results = [];

        $em = $this->getDoctrine()->getManager();

        $date = $this->get('event_to_date')->transform($date, $em);

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }

        $characters_trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByCoordAndDateForAll($place[0]->getCoordx(), $place[0]->getCoordy(), $date);
        array_push($results, $place);
        array_push($results, $characters_trip);

        $view = $this->view($results);
        return $this->handleView($view);
    }

    public function getPlaceAllCharactersByPeriodAction($slug, $date1, $date2)
    {
        $results = [];

        $em = $this->getDoctrine()->getManager();

        $date1 = $this->get('event_to_date')->transform($date1, $em);
        $date2 = $this->get('event_to_date')->transform($date2, $em);

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }

        $characters_trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByPeriodAndPresenceForAll($date1, $date2, $place[0]->getCoordx(), $place[0]->getCoordy());
        array_push($results, $place);
        array_push($results, $characters_trip);

        $view = $this->view($results);
        return $this->handleView($view);
    }
}
