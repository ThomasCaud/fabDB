<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
     * @Groups({"marketplace"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('photo','video')")
     */
    private $type;

    /**
     * @var string
     * @Groups({"marketplace"})
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @Groups({"marketplace"})
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

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return URL
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
