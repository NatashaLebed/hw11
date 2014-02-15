<?php

namespace Lebed\GuestbookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Message
 * @package Lebed\GuestbookBundle\Entity
 * @ORM\Entity(repositoryClass="Lebed\GuestbookBundle\Entity\MessageRepository")
 * @ORM\Table(name="message")
 */
class Message
{
    /** @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $author;

    /** @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Email(message = "Friend! Enter a correct email, please.")
     */
    protected $mail;

    /** @ORM\Column(type="text") */
    protected $message;

    /**
     * @var datetime $posted_date
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $posted_date;

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
     * Set author
     *
     * @param string $author
     * @return Message
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Message
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set posted_date
     *
     * @param \DateTime $postedDate
     * @return Message
     */
    public function setPostedDate($postedDate)
    {
        $this->posted_date = $postedDate;

        return $this;
    }

    /**
     * Get posted_date
     *
     * @return \DateTime 
     */
    public function getPostedDate()
    {
        return $this->posted_date;
    }
}
