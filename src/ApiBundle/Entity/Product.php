<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     * @Groups({"user","fablab"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string|null
     * @Groups({"user","fablab"})
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var float
     * @Groups({"user","fablab"})
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float|null
     * @Groups({"user","fablab"})
     * @ORM\Column(name="discount", type="float", nullable=true)
     */
    private $discount;

    /**
     * @var int|null
     * @Groups({"user","fablab"})
     * @ORM\Column(name="stock", type="integer", nullable=true)
     */
    private $stock;

    /**
     * @var \DateTime
     * @Groups({"user","fablab"})
     * @ORM\Column(name="publication", type="datetime")
     */
    private $publication;

    /**
     * @Groups({"user","fablab"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     */
    private $maker;

    /**
     * @Groups({"user","fablab"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Category")
     */
    private $category;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Product
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return Product
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
     * Set discount.
     *
     * @param float|null $discount
     *
     * @return Product
     */
    public function setDiscount($discount = null)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount.
     *
     * @return float|null
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set stock.
     *
     * @param int|null $stock
     *
     * @return Product
     */
    public function setStock($stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return int|null
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set publication.
     *
     * @param \DateTime $publication
     *
     * @return Product
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication.
     *
     * @return \DateTime
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set maker.
     *
     * @param \ApiBundle\Entity\User|null $maker
     *
     * @return Product
     */
    public function setMaker(\ApiBundle\Entity\User $maker = null)
    {
        $this->maker = $maker;

        return $this;
    }

    /**
     * Get maker.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getMaker()
    {
        return $this->maker;
    }

    /**
     * Set category.
     *
     * @param \ApiBundle\Entity\Category|null $category
     *
     * @return Product
     */
    public function setCategory(\ApiBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \ApiBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
