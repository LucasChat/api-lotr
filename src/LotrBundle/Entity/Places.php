<?php

namespace LotrBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Places
 *
 * @ORM\Table(name="places")
 * @ORM\Entity
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
     * @var boolean
     *
     * @ORM\Column(name="coordX", type="boolean", nullable=false)
     */
    private $coordx;

    /**
     * @var boolean
     *
     * @ORM\Column(name="coordY", type="boolean", nullable=false)
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
     * @param boolean $coordx
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
     * @return boolean 
     */
    public function getCoordx()
    {
        return $this->coordx;
    }

    /**
     * Set coordy
     *
     * @param boolean $coordy
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
     * @return boolean 
     */
    public function getCoordy()
    {
        return $this->coordy;
    }
}
