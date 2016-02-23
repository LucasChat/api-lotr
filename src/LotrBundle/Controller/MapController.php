<?php

namespace LotrBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MapController
 * Controller to get undrawn map - accept ?type=1, 2, 3, 4 or 5
 * @package LotrBundle\Controller
 */
class MapController extends FOSRestController
{
	/**
	 * Get undrawn map.
	 * type=0 -> no legend, no numbers, no grid  |
	 * type=1 -> [legend], no numbers, no grid  |
	 * type=2 -> no legend, [numbers], no grid  |
	 * type=3 -> no legend, [numbers], [grid]  |
	 * type=4 -> [legend], [numbers], no grid  |
	 * type=5 -> [legend], [numbers], [grid]  |
	 *
	 * @param Request $request
	 * @Route("/map")
	 */
	public function getMapAction(Request $request)
	{
		$this->get('map_generator')->generate($request->query->get('type'));
	}
}
