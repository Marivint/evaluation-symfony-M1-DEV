<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=3, max=255)
     */
    public $name;
    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    public $subject;
    /**
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    public $message;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}