<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Validator\Constraints\Image;

/**
 * Class PlacesController
 * Controller for all Places routes
 * @package LotrBundle\Controller
 */
class PlacesController extends FOSRestController
{
    /**
     * GET all the places (id, slug, name, coordX and coordY).
     * The format .png is accepted
     *
     * @Get("/places.{_format}")
     * @param Request $request
     * @param string $_format
     * @return JsonResponse|Image
     */
    public function getPlacesAction(Request $request, $_format)
    {
        $em = $this->getDoctrine()->getManager();

        $places = $em->getRepository('LotrBundle:Places')->findAll();

        if($_format == 'png' && gettype($places) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), null, $places);
        }

        $view = $this->view($places);
        return $this->handleView($view);
    }

    /**
     * GET a single place (id, slug, name, coordX and coordY).
     * The format .png is accepted
     *
     * @Get("/place/{slug}.{_format}")
     * @param Request $request
     * @param string $slug
     * @param string $_format
     * @return JsonResponse|Image
     */
    public function getPlaceAction($slug, Request $request, $_format)
    {
        $em = $this->getDoctrine()->getManager();

        $place = $em->getRepository('LotrBundle:Places')->findBySlug($slug);
        if(!$place)
        {
            throw new NotFoundHttpException("Place not found");
        }

        if($_format == 'png' && gettype($place) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), null, $place);
        }

        $view = $this->view($place);
        return $this->handleView($view);
    }

    /**
     * GET date of passage of all characters in a specific place.
     *
     * @Get("/place/{slug}/characters.{_format}")
     * @param string $slug
     * @return JsonResponse
     */
    public function getPlaceAllCharactersAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

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

    /**
     * GET who was in a specific place at a specific date, in all characters.
     *
     * @Get("/place/{slug}/characters/date/{date}.{_format}")
     * @param string $slug
     * @param \Datetime|string $date
     * @return JsonResponse
     */
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

    /**
     * GET who was in a specific place during a specific period, in all characters.
     *
     * @Get("/place/{slug}/characters/period/{date1}/{date2}.{_format}")
     * @param string $slug
     * @param \Datetime|string $date1
     * @param \Datetime|string $date2
     * @return JsonResponse
     */
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
