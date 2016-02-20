<?php

namespace LotrBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CharactersTripRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CharactersTripRepository extends EntityRepository
{
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
