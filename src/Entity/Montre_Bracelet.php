<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @package App\Entity*
 */
class Montre_Bracelet{

    use idTrait;

    /**
     * @ORM\Column(type="string")
     */
    private $intitule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Montre")
     */
    private $montre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bracelet")
     */
    private $bracelet;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

}