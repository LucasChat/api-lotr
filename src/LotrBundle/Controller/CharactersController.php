<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class CharactersController extends FOSRestController
{
    public function getCharactersAction()
    {
        $em = $this->getDoctrine()->getManager();

        $characters = $em->getRepository('LotrBundle:Characters')->findAll();

        // var_dump($characters);die();
        $view = $this->view($characters);

        return $this->handleView($view);
    }


    public function getCharacterAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        // var_dump($characters);die();
        $view = $this->view($character);

        return $this->handleView($view);
    }

    public function getCharacterTripByDateAction($slug, $date)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        $trip = $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByDate($id, $date);

//        var_dump($characters);die();
        $view = $this->view($trip);

        return $this->handleView($view);
    }

}
