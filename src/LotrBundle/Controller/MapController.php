<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MapController extends FOSRestController
{
	/**
	 *
	 * GET Route annotation.
	 * @param Request $request
	 * @Route("/map")
	 */
	public function getMapAction(Request $request)
	{
		$this->get('map_generator')->generate($request->query->get('type'));
	}
}
