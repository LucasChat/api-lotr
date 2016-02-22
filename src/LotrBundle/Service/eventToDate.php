<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 20/02/2016
 * Time: 16:24
 */

namespace LotrBundle\Service;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Accept a date or an event and return a correct date for search in database
 *
 * Class EventToDate
 * @package LotrBundle\Service
 */
class EventToDate
{
    /**
     * @param $unknown
     * @param $em
     * @return mixed
     */
    public function transform($unknown, $em)
    {
        $format = 'Y-m-d';

        $DateTime = \DateTime::createFromFormat($format, $unknown);

        // Date valide
        if($DateTime && $unknown == $DateTime->format($format))
        {
            return $unknown;
        }
        // Date non valide, event ?
        else
        {
            $event = $em->getRepository('LotrBundle:Events')->findBySlug($unknown);
            if(!$event)
            {
                throw new NotFoundHttpException("Date (or event) not found");
            }
            else
            {
                return $event[0]->getDate();
            }
        }
    }
}