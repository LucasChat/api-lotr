<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class AdminController extends FOSRestController
{
    /**
     * @Route("/")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('admin/index.html.twig', array(
            'characters' => $em->getRepository('LotrBundle:Characters')->findAll(),
            'places' => $em->getRepository('LotrBundle:Places')->findAll(),
            'events' => $em->getRepository('LotrBundle:Events')->findAll(),
            'races' => $em->getRepository('LotrBundle:Races')->findAll(),
            'status' => $em->getRepository('LotrBundle:Status')->findAll(),
            'activePage' => 'dashboard',
        ));
    }

}
