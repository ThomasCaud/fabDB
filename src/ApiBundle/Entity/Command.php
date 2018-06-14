<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"marketplace"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"marketplace"})
     * @ORM\Column(name="lastDigitCard", type="integer")
     */
    private $lastDigitCard;

    /**
     * @var \DateTime
     * @Groups({"marketplace"})
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('pending','paid','cancelled')")
     */
    private $status;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="billingAddress", type="string", length=255)
     */
    private $billingAddress;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="deliveryAddress", type="string", length=255)
     */
    private $deliveryAddress;

    /**
     * @Groups({"marketplace"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     */
    private $purchaser;

    /**
     * @Groups({"marketplace"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Purchase", cascade={"persist", "remove"}, mappedBy="command")
     */
    protected $purchases;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="delivery_method", type="string", columnDefinition="ENUM('colissimo','fablab')")
     */
    private $delivery_method;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="payment_method", type="string", columnDefinition="ENUM('credit card','paypal','blockchain')")
     */
    private $payment_method;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->purchases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add purchase.
     *
     * @param \ApiBundle\Entity\Purchase $purchase
     *
     * @return Command
     */
    public function addPurchase(\ApiBundle\Entity\Purchase $purchase)
    {
        $this->purchases[] = $purchase;

        return $this;
    }

    /**
     * Remove purchase.
     *
     * @param \ApiBundle\Entity\Purchase $purchase
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePurchase(\ApiBundle\Entity\Purchase $purchase)
    {
        return $this->purchases->removeElement($purchase);
    }

    /**
     * Get purchases.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPurchases()
    {
        return $this->purchases;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Command
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

    /**
     * Set deliveryMethod.
     *
     * @param string $deliveryMethod
     *
     * @return Command
     */
    public function setDeliveryMethod($deliveryMethod)
    {
        $this->delivery_method = $deliveryMethod;

        return $this;
    }

    /**
     * Get deliveryMethod.
     *
     * @return string
     */
    public function getDeliveryMethod()
    {
        return $this->delivery_method;
    }

    /**
     * Set paymentMethod.
     *
     * @param string $paymentMethod
     *
     * @return Command
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->payment_method = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod.
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }
}
