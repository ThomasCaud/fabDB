<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fablab
 *
 * @ORM\Table(name="fablab")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\FablabRepository")
 */
class Fablab
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="PC", type="string", length=255)
     */
    private $pC;


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
     * Set address.
     *
     * @param string $address
     *
     * @return Fablab
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set pC.
     *
     * @param string $pC
     *
     * @return Fablab
     */
    public function setPC($pC)
    {
        $this->pC = $pC;

        return $this;
    }

    /**
     * Get pC.
     *
     * @return string
     */
    public function getPC()
    {
        return $this->pC;
    }
}
