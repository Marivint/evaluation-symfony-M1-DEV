<?php
/**
 * Created by PhpStorm.
 * User: Yvann
 * Date: 13/11/2018
 * Time: 13:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait idTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}