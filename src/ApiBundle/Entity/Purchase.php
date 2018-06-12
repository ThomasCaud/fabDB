<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Purchase
 *
 * @ORM\Table(name="purchase")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PurchaseRepository")
 */
class Purchase
{
    /**
     * @var int
     * @Groups({"command", "purchase", "user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"command", "purchase", "user"})
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     * @Groups({"command", "purchase", "user"})
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Command", inversedBy="purchases", cascade={"persist"})
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id", nullable=false)
     */
    private $command;

    /**
     * @Groups({"command","purchase","user"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Product")
     */
    private $product;

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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return Purchase
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return Purchase
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set product.
     *
     * @param \ApiBundle\Entity\Product|null $product
     *
     * @return Purchase
     */
    public function setProduct(\ApiBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \ApiBundle\Entity\Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set commandId.
     *
     * @param \ApiBundle\Entity\Command|null $commandId
     *
     * @return Purchase
     */
    public function setCommandId(\ApiBundle\Entity\Command $commandId = null)
    {
        $this->commandId = $commandId;

        return $this;
    }

    /**
     * Get commandId.
     *
     * @return \ApiBundle\Entity\Command|null
     */
    public function getCommandId()
    {
        return $this->commandId;
    }

    /**
     * Set command.
     *
     * @param \ApiBundle\Entity\Command|null $command
     *
     * @return Purchase
     */
    public function setCommand(\ApiBundle\Entity\Command $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command.
     *
     * @return \ApiBundle\Entity\Command|null
     */
    public function getCommand()
    {
        return $this->command;
    }
}
