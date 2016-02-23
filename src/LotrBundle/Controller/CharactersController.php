<?php
namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Validator\Constraints\Image;

/**
 * Class CharactersController
 * Controller for all Character or Characters routes
 * @package LotrBundle\Controller
 */
class CharactersController extends FOSRestController
{
    /**
     * GET all the characters definition (id, slug, name, race).
     *
     * @Get("/characters.{_format}")
     * @param Request $request
     * @return JsonResponse
     */
    public function getCharactersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->query->get('who'))
        {
            $whos = explode('-', $request->query->get('who'));
            $characters = [];
            foreach($whos as $who)
            {
                array_push($characters, $em->getRepository('LotrBundle:Characters')->findBySlug($who));
            }
            if(!$characters[0])
            {
                throw new NotFoundHttpException("Character(s) not found");
            }
        }
        else
        {
            $characters = $em->getRepository('LotrBundle:Characters')->findAll();
        }

        $view = $this->view($characters);
        return $this->handleView($view);
    }

    /**
     * GET all characters (or a selection of them) position for a date (real date or event accepted).
     *
     * @Get("/characters/date/{date}.{_format}")
     * @param Request $request
     * @param \Datetime|String $date
     * @return JsonResponse
     */
    public function getCharactersByDateAction($date, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $date = $this->get('event_to_date')->transform($date, $em);

        if($request->query->get('who'))
        {
            $whos = explode('-', $request->query->get('who'));
            $trip = [];
            foreach($whos as $who)
            {
                $character = $em->getRepository('LotrBundle:Characters')->findBySlug($who);
                array_push($trip, $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByDateForOne($character, $date));
            }
            if(!$trip[0])
            {
                throw new NotFoundHttpException("Character(s) not found");
            }
        }
        else
        {
            $trip = $em->getRepository('LotrBundle:CharactersTrip')
                ->getCharactersTripByDateForAll($date);
        }

        $view = $this->view($trip);
        return $this->handleView($view);
    }

    /**
     * GET all characters position (or a selection of them) during a period (real date or event accepted).
     *
     * @Get("/characters/period/{date1}/{date2}.{_format}")
     * @param Request $request
     * @param \Datetime|string $date1
     * @param \Datetime|string $date2
     * @return JsonResponse
     */
    public function getCharactersByPeriodAction($date1, $date2, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $date1 = $this->get('event_to_date')->transform($date1, $em);
        $date2 = $this->get('event_to_date')->transform($date2, $em);

        if($request->query->get('who'))
        {
            $whos = explode('-', $request->query->get('who'));
            $trip = [];
            foreach($whos as $who)
            {
                $character = $em->getRepository('LotrBundle:Characters')->findBySlug($who);
                array_push($trip, $em->getRepository('LotrBundle:CharactersTrip')->getCharactersTripByPeriodForOne($character, $date1, $date2));
            }
            if(!$trip[0])
            {
                throw new NotFoundHttpException("Character(s) not found");
            }
        }
        else
        {
            $trip = $em->getRepository('LotrBundle:CharactersTrip')
                ->getCharactersTripByPeriodForAll($date1, $date2);
        }

        $view = $this->view($trip);
        return $this->handleView($view);
    }






    /**
     * GET a single character definition (id, slug, name, race).
     *
     * @Get("/character/{slug}.{_format}")
     * @param String $slug
     * @return JsonResponse
     */
    public function getCharacterAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }

        $view = $this->view($character);
        return $this->handleView($view);
    }

    /**
     * GET a single character position for a date (real date or event accepted).
     *
     * @Get("/character/{slug}/date/{date}.{_format}")
     * @param String $slug
     * @param \Datetime|String $date
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripByDateAction($slug, $date, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        $date = $this->get('event_to_date')->transform($date, $em);

        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }

        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByDateForOne($character, $date);

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip);
        }

        $view = $this->view($trip);
        return $this->handleView($view);
    }

    /**
     * GET for a single character all days passed in a specific place.
     *
     * @Get("/character/{slug}/place/{place}.{_format}")
     * @param String $slug
     * @param String $place
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripByPlaceAction($slug, $place, Request $request)
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

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip, $place);
        }

        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }

    /**
     * GET if a single character was in a specific place at a specific date (real date or event accepted).
     *
     * @Get("/character/{slug}/place/{place}/date/{date}.{_format}")
     * @param String $slug
     * @param String $place
     * @param \Datetime|String $date
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripByPlaceAndDateAction($slug, $place, $date, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        $date = $this->get('event_to_date')->transform($date, $em);

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

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip, $place);
        }

        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }

    /**
     * GET a single character position during a period (real date or event accepted).
     *
     * @Get("/character/{slug}/period/{date1}/{date2}.{_format}")
     * @param String $slug
     * @param \Datetime|String $date1
     * @param \Datetime|String $date2
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripByPeriodAction($slug, $date1, $date2, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        $date1 = $this->get('event_to_date')->transform($date1, $em);
        $date2 = $this->get('event_to_date')->transform($date2, $em);

        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }

        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByPeriodForOne($character, $date1, $date2);

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip);
        }

        $view = $this->view($trip);
        return $this->handleView($view);
    }

    /**
     * GET if a single character was in a specific place during a specific period (real date or event accepted).
     *
     * @Get("/character/{slug}/place/{place}/period/{date1}/{date2}.{_format}")
     * @param String $slug
     * @param String $place
     * @param \Datetime|String $date1
     * @param \Datetime|String $date2
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripByPlaceAndPeriodAction($slug, $place, $date1, $date2, Request $request)
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

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip, $place);
        }

        $results = [];
        array_push($results, $place, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }

    /**
     * GET for a single character his position(s) during an event.
     *
     * @Get("/character/{slug}/event/{event}/position.{_format}")
     * @param String $slug
     * @param String $event
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripPositionByEventAction($slug, $event, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $event = $em->getRepository('LotrBundle:Events')->findBySlug($event);
        if(!$event)
        {
            throw new NotFoundHttpException("Event not found");
        }

        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getCharactersTripByPeriodForOne($character, $event[0]->getDate() , $event[0]->getDateEnd());

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip, $event);
        }

        $results = [];
        array_push($results, $event, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }

    /**
     * GET if a single character was present at an event.
     *
     * @Get("/character/{slug}/event/{event}/present.{_format}")
     * @param String $slug
     * @param String $event
     * @param Request $request
     * @return JsonResponse|Image
     */
    public function getCharacterTripPresentByEventAction($slug, $event, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $character = $em->getRepository('LotrBundle:Characters')->findBySlug($slug);

        if(!$character)
        {
            throw new NotFoundHttpException("Character not found");
        }
        $event = $em->getRepository('LotrBundle:Events')->findBySlug($event);
        if(!$event)
        {
            throw new NotFoundHttpException("Event not found");
        }

        $trip = $em->getRepository('LotrBundle:CharactersTrip')
            ->getOneCharactersTripByPlaceAndPeriodForOne($character, $event[0]->getCoordx(), $event[0]->getCoordy(), $event[0]->getDate(), $event[0]->getDateEnd());

        if($request->query->get('format') == 'png' && gettype($trip) == 'array')
        {
            $this->get('map_generator')->generate($request->query->get('type'), $trip, $event);
        }

        $results = [];
        array_push($results, $event, $trip);
        $view = $this->view($results);
        return $this->handleView($view);
    }
}