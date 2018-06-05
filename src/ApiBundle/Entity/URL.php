<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * URL
 *
 * @ORM\Table(name="url")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\URLRepository")
 */
class URL
{
    /**
     * @var int
     * @Groups({"all","user","fablab"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"all","user","fablab"})
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('photo','video')")
     */
    private $type;

    /**
     * @var string
     * @Groups({"all","user","fablab"})
     * @ORM\Column(name="URL", type="string", length=255)
     */
    private $uRL;

    /**
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
     * Set type.
     *
     * @param string $type
     *
     * @return URL
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set uRL.
     *
     * @param string $uRL
     *
     * @return URL
     */
    public function setURL($uRL)
    {
        $this->uRL = $uRL;

        return $this;
    }

    /**
     * Get uRL.
     *
     * @return string
     */
    public function getURL()
    {
        return $this->uRL;
    }

    /**
     * Set product.
     *
     * @param \ApiBundle\Entity\Product|null $product
     *
     * @return URL
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
}
