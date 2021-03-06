<?php

namespace LotrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Places
 *
 * @ORM\Table(name="places")
 * @ORM\Entity(repositoryClass="LotrBundle\Repository\CharactersTripRepository")
 */
class Places
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="coordX", type="integer", nullable=false)
     */
    private $coordx;

    /**
     * @var integer
     *
     * @ORM\Column(name="coordY", type="integer", nullable=false)
     */
    private $coordy;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Places
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Places
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set coordx
     *
     * @param integer $coordx
     * @return Places
     */
    public function setCoordx($coordx)
    {
        $this->coordx = $coordx;

        return $this;
    }

    /**
     * Get coordx
     *
     * @return integer
     */
    public function getCoordx()
    {
        return $this->coordx;
    }

    /**
     * Set coordy
     *
     * @param integer $coordy
     * @return Places
     */
    public function setCoordy($coordy)
    {
        $this->coordy = $coordy;

        return $this;
    }

    /**
     * Get coordy
     *
     * @return integer
     */
    public function getCoordy()
    {
        return $this->coordy;
    }
}
