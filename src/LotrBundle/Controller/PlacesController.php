<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
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
}
