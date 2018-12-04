<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @package App\Entity*
 */
class Utilisateur implements UserInterface {

    use idTrait;

    /**
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @ORM\Column(type="string")
     */
    private $prenom;

    /**
     * @var string
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Length(max=255)
     */
    private $mdp;

    /**
     * @var string
     */
    private $raw_mdp;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type("bool")
     */
    private $admin = 0;

    /**
     * @ORM\Column(type="date")
     */
    private $date_crea;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande")
     */
    private $commandes;

    /**
     * @return string
     */
    public function getRawMdp(): string
    {
        return $this->raw_mdp;
    }

    /**
     * @param string $raw_mdp
     */
    public function setRawMdp(string $raw_mdp)
    {
        $this->raw_mdp = $raw_mdp;
    }

    /**
     * @return mixed
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * @param mixed $commandes
     */
    public function setCommandes($commandes)
    {
        $this->commandes = $commandes;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
          $this->admin ? "ROLE_ADMIN" : "ROLE_USER" ,
        ];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->mdp;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp(string $mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(bool $admin)
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getDateCrea()
    {
        return $this->date_crea;
    }

    /**
     * @param mixed $date_crea
     */
    public function setDateCrea($date_crea)
    {
        $this->date_crea = $date_crea;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}