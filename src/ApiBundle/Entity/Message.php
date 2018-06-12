<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @var int
     * @Groups({"message","user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="from", cascade="persist")
     * @Groups({"message","user"})
     */
    private $from;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="to", cascade="persist")
     * @Groups({"message","user"})
     */
    private $to;

    /**
     * @var string
     * @Groups({"message","user"})
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set from.
     *
     * @param \ApiBundle\Entity\User|null $from
     *
     * @return Message
     */
    public function setFrom(\ApiBundle\Entity\User $from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to.
     *
     * @param \ApiBundle\Entity\User|null $to
     *
     * @return Message
     */
    public function setTo(\ApiBundle\Entity\User $to = null)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getTo()
    {
        return $this->to;
    }
}
