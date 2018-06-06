<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\CommandRepository")
 */
class Command
{
    /**
     * @var int
     * @Groups({"command","user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"command","user"})
     * @ORM\Column(name="lastDigitCard", type="integer")
     */
    private $lastDigitCard;

    /**
     * @var \DateTime
     * @Groups({"command","user"})
     * @ORM\Column(name="dateCommand", type="datetime")
     */
    private $dateCommand;

    /**
     * @var string
     * @Groups({"command","user"})
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('pending','paid','cancelled')")
     */
    private $status;

    /**
     * @var string
     * @Groups({"command","user"})
     * @ORM\Column(name="billingAddress", type="string", length=255)
     */
    private $billingAddress;

    /**
     * @var string
     * @Groups({"command","user"})
     * @ORM\Column(name="deliveryAddress", type="string", length=255)
     */
    private $deliveryAddress;

    /**
     * @Groups({"command"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     */
    private $purchaser;


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
     * Set lastDigitCard.
     *
     * @param int $lastDigitCard
     *
     * @return Command
     */
    public function setLastDigitCard($lastDigitCard)
    {
        $this->lastDigitCard = $lastDigitCard;

        return $this;
    }

    /**
     * Get lastDigitCard.
     *
     * @return int
     */
    public function getLastDigitCard()
    {
        return $this->lastDigitCard;
    }

    /**
     * Set dateCommand.
     *
     * @param \DateTime $dateCommand
     *
     * @return Command
     */
    public function setDateCommand($dateCommand)
    {
        $this->dateCommand = $dateCommand;

        return $this;
    }

    /**
     * Get dateCommand.
     *
     * @return \DateTime
     */
    public function getDateCommand()
    {
        return $this->dateCommand;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Command
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set billingAddress.
     *
     * @param string $billingAddress
     *
     * @return Command
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress.
     *
     * @return string
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set deliveryAddress.
     *
     * @param string $deliveryAddress
     *
     * @return Command
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress.
     *
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set purchaser.
     *
     * @param \ApiBundle\Entity\User|null $purchaser
     *
     * @return Command
     */
    public function setPurchaser(\ApiBundle\Entity\User $purchaser = null)
    {
        $this->purchaser = $purchaser;

        return $this;
    }

    /**
     * Get purchaser.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getPurchaser()
    {
        return $this->purchaser;
    }
}
