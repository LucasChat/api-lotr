<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use LotrBundle\LotrBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlacesController extends FOSRestController
{
    public function getPlacesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $places = $em->getRepository('LotrBundle:Places')->findAll();

        $view = $this->view($places);
        return $this->handleView($view);
    }


    public function getPlaceAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);

        $view = $this->view($place);
        return $this->handleView($view);
    }

    public function getPlaceAllCharactersAction($slug)
    {
        $results = [];

        $em = $this->getDoctrine()->getManager();

//        $place_test = $this->getPlaceAction($slug)->getContent(true);
//        $placeJson = $this->get('jms_serializer')->deserialize($place, 'LotrBundle\Entity\Places', 'json');

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if($place)
        {
            $characters_trip = $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByCoord($place[0]->getCoordx(), $place[0]->getCoordy());
            array_push($results, $place);
            array_push($results, $characters_trip);
        }
        else
        {
            array_push($results, 'No place founded');
        }

        $view = $this->view($results);
        return $this->handleView($view);
    }
}
