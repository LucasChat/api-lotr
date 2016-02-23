<?php

namespace LotrBundle\Repository;

use Doctrine\ORM\EntityRepository;
use phpDocumentor\Partials\Collection;


/**
 * Class CharactersTripRepository
 * Repository for all custom call to the database on the table characters_trip
 *
 * @package LotrBundle\Repository
 */
class CharactersTripRepository extends EntityRepository
{
    /**
     * Search a row for a specific date and a specific character
     *
     * @param Collection $character
     * @param string $date
     * @return array|string
     */
    public function getCharactersTripByDateForOne($character, $date)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.date = :date AND c.character = :slug')
            ->setParameter('date', $date)
            ->setParameter('slug', $character)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : date not found";
        }

        return $result;
    }

    /**
     * Search a row for a specific place and a specific character
     *
     * @param Collection $character
     * @param integer $coordX
     * @param integer $coordY
     * @return array|string
     */
    public function getCharactersTripByCoordForOne($character, $coordX, $coordY)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.character = :character AND c.coordx = :coordX AND c.coordy = :coordY')
            ->setParameter('character', $character)
            ->setParameter('coordX', $coordX)
            ->setParameter('coordY', $coordY)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : " . $character[0]->getSlug() . " never passed here";
        }

        return $result;
    }

    /**
     * Search a row for a specific date, a specific place and a specific character
     *
     * @param Collection $character
     * @param integer $coordX
     * @param integer $coordY
     * @param string $date
     * @return array|string
     */
    public function getCharactersTripByCoordAndDateForOne($character, $coordX, $coordY, $date)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.character = :character AND c.coordx = :coordX AND c.coordy = :coordY AND c.date = :date')
            ->setParameter('character', $character)
            ->setParameter('coordX', $coordX)
            ->setParameter('coordY', $coordY)
            ->setParameter('date', $date)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : " . $character[0]->getSlug() . " wasn't here at this date";
        }

        return $result;
    }

    /**
     * Search the rows for a specific period and a specific character
     *
     * @param Collection $character
     * @param string $date1
     * @param string $date2
     * @return array|string
     */
    public function getCharactersTripByPeriodForOne($character, $date1, $date2)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.character = :character AND c.date BETWEEN :date1 AND :date2')
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->setParameter('character', $character)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : period not found";
        }

        return $result;
    }

    /**
     * Search the rows for a specific place during a specific period, for a specific character
     *
     * @param Collection $character
     * @param integer $coordX
     * @param integer $coordY
     * @param string $date1
     * @param string $date2
     * @return array|string
     */
    public function getOneCharactersTripByPlaceAndPeriodForOne($character, $coordX, $coordY, $date1, $date2)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.character = :character AND c.coordx = :coordX AND c.coordy = :coordY AND c.date BETWEEN :date1 AND :date2')
            ->setParameter('character', $character)
            ->setParameter('coordX', $coordX)
            ->setParameter('coordY', $coordY)
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : " . $character[0]->getSlug() . " was not here during this period";
        }

        return $result;
    }


    /**
     * Search the rows for a specific date for all characters
     *
     * @param string $date
     * @return array|string
     */
    public function getCharactersTripByDateForAll($date)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.date = :date')
            ->setParameter('date', $date)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : date not found";
        }

        return $result;
    }

    /**
     * Search the rows for a specific place for all characters
     *
     * @param integer $coordX
     * @param integer $coordY
     * @return array|string
     */
    public function getCharactersTripByCoordForAll($coordX, $coordY)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.coordx = :coordX AND c.coordy = :coordY')
            ->setParameter('coordX', $coordX)
            ->setParameter('coordY', $coordY)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : coordinates not found";
        }

        return $result;
    }

    /**
     * Search the rows for a specific date and a specific place for all characters
     *
     * @param integer $coordX
     * @param integer $coordY
     * @param string $date
     * @return array|string
     */
    public function getCharactersTripByCoordAndDateForAll($coordX, $coordY, $date)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.coordx = :coordX AND c.coordy = :coordY AND c.date = :date')
            ->setParameter('coordX', $coordX)
            ->setParameter('coordY', $coordY)
            ->setParameter('date', $date)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : nobody here at this date";
        }

        return $result;
    }

    /**
     * Search the rows between a period for all characters
     *
     * @param string $date1
     * @param string $date2
     * @return array|string
     */
    public function getCharactersTripByPeriodForAll($date1, $date2)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.date BETWEEN :date1 AND :date2')
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : nobody here at this date";
        }

        return $result;
    }

    /**
     * Search the rows between a period where place watch, for all characters
     *
     * @param string $date1
     * @param string $date2
     * @param integer $coordX
     * @param integer $coordY
     * @return array|string
     */
    public function getCharactersTripByPeriodAndPresenceForAll($date1, $date2, $coordX, $coordY)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.coordx = :coordx AND c.coordy = :coordy AND c.date BETWEEN :date1 AND :date2')
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->setParameter('coordx', $coordX)
            ->setParameter('coordy', $coordY)
            ->getQuery();

        $result = $query->getResult();

        if(!$result)
        {
            $result = "error : nobody here at this date";
        }

        return $result;
    }
}
