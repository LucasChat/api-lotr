<?php

namespace LotrBundle\Controller;

use LotrBundle\Entity\Places;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\RestBundle\Controller\FOSRestController;
use LotrBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Tests\Extension\Core\Type\IntegerTypeTest;
use Symfony\Component\HttpFoundation\Request;

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
            'pageActive' => 'dashboard',
        ));
    }

    /**
     * @Route("/new/event")
     */
    public function newEventAction(Request $request)
    {
        $event = new Events();

        $form = $this->createFormBuilder($event)
            ->add('slug', TextType::class, array(
                'label' => 'Slug',
                'attr' => array(
                    'placeholder' => 'mon-nouvel-evenement',
                ),
            ))
            ->add('name', TextType::class, array(
                'label' => 'Nom de l\'événement',
                'attr' => array(
                    'placeholder' => 'Mon nouvel événement',
                ),
            ))
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de début',
            ))
            ->add('dateEnd', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de fin',
            ))
            ->add('coordX', IntegerType::class, array(
                'label' => 'Coordonnée X',
                'empty_data' => -1,
                'data' => -1,
                'attr' => array(
                    'min' => -1,
                    'max' => 100,
                ),
            ))
            ->add('coordY', IntegerType::class, array(
                'label' => 'Coordonnée Y',
                'empty_data' => -1,
                'data' => -1,
                'attr' => array(
                    'min' => -1,
                    'max' => 100,
                ),
            ))
            ->add('save', SubmitType::class, array('label' => 'Ajouter un événement'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('get_event', array('slug' => $event->getSlug()));
        }

        return $this->render('admin/new.html.twig', array(
           'pageActive' => 'new_event',
            'subtitle' => 'Ajouter un événement',
            'h2' => 'Ajouter un événement',
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/new/place")
     */
    public function newPlaceAction(Request $request)
    {
        $place = new Places();

        $form = $this->createFormBuilder($place)
            ->add('slug', TextType::class, array(
                'label' => 'Slug',
                'attr' => array(
                    'placeholder' => 'my-new-places-name',
                ),
            ))
            ->add('name', TextType::class, array(
                'label' => 'Place\'s name',
                'attr' => array(
                    'placeholder' => 'My new place\'s name',
                ),
            ))
            ->add('coordX', IntegerType::class, array(
                'label' => 'Coord X',
                'empty_data' => -1,
                'data' => -1,
                'attr' => array(
                    'min' => -1,
                    'max' => 100,
                ),
            ))
            ->add('coordY', IntegerType::class, array(
                'label' => 'Coord Y',
                'empty_data' => -1,
                'data' => -1,
                'attr' => array(
                    'min' => -1,
                    'max' => 100,
                ),
            ))
            ->add('save', SubmitType::class, array('label' => 'Create place'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($place);
            $em->flush();

            return $this->redirectToRoute('get_place', array('slug' => $place->getSlug()));
        }

        return $this->render('admin/new.html.twig', array(
            'pageActive' => 'new_place',
            'subtitle' => 'Create place',
            'h2' => 'Create a new place',
            'form' => $form->createView(),
        ));
    }
}
