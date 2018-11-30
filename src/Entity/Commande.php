<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @package App\Entity*
 */
class Commande{

    use idTrait;

    private $intitule;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    private $prix;

}