<?php

namespace LotrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RacesController extends Controller
{
    /**
     * @Route("/showRaces")
     */
    public function showRacesAction()
    {
        return $this->render('LotrBundle:Races:show_races.html.twig', array(
            // ...
        ));
    }

}
