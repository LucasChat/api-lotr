<?php
namespace LotrBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class CharactersController extends FOSRestController
{
    public function getCharactersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $characters = $em->getRepository('LotrBundle:Characters')->findAll();
        $view = $this->view($characters);
        return $this->handleView($view);
    }
    public function getCharacterAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        $view = $this->view($character);
        return $this->handleView($view);
    }
    public function getCharacterTripByDateAction($slug, $date)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByDateForOne($character, $date);
        $view = $this->view($trip);
        return $this->handleView($view);
    }
    public function getCharacterTripByPlaceAction($slug, $place)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $place = $em->getRepository('LotrBundle:Places')->findBySlug($place);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }
        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByCoordForOne($character, $place[0]->getCoordx(), $place[0]->getCoordy());
        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }
    public function getCharacterTripByPlaceAndDateAction($slug, $place, $date)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $place = $em->getRepository('LotrBundle:Places')->findBySlug($place);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }
        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByCoordAndDateForOne($character, $place[0]->getCoordx(), $place[0]->getCoordy(), $date);
        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }
    public function getCharacterTripByPeriodAction($slug, $date1, $date2)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByPeriodForOne($character, $date1, $date2);
        $view = $this->view($trip);
        return $this->handleView($view);
    }
    public function getCharacterTripByPlaceAndPeriodAction($slug, $place, $date1, $date2)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);
        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $place = $em->getRepository('LotrBundle:Places')->findBySlug($place);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }
        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getOneCharactersTripByPlaceAndPeriodForOne($character, $place[0]->getCoordx(), $place[0]->getCoordy(), $date1, $date2);
        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }
}