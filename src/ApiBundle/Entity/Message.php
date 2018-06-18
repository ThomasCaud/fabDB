<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"userscommunication"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="from", cascade="persist")
     * @Groups({"userscommunication"})
     */
    private $from;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="to", cascade="persist")
     * @Groups({"userscommunication"})
     */
    private $to;

    /**
     * @var string
     * @Groups({"message","user"})
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;

    /**
     * @var boolean
     * @Groups({"message","user"})
     * @ORM\Column(name="seen", type="boolean", length=255, options={"default":false})
     */
    private $seen;

    /**
     * @var \DateTime
     * @Groups({"message","user"})
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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

    /**
     * Set seen.
     *
     * @param bool $seen
     *
     * @return Message
     */
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * Get seen.
     *
     * @return bool
     */
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
