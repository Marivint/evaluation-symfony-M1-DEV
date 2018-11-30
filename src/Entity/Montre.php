<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @package App\Entity*
 */
class Montre{

    use idTrait;

    /**
     * @ORM\Column(type="text")
     */
    private $intitule;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $scr_image;

    /**
     * One product has many features. This is the inverse side.
     * @ORM\ManyToMany(targetEntity="App\Entity\Bracelet")
     */
    private $bracelets;


    /**
     * @return mixed
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * @param mixed $intitule
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}