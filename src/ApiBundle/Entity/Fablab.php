<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fablab
 *
 * @ORM\Table(name="fablab")
 * @ORM\Entity
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
    private $pc;


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
     * Set pc.
     *
     * @param string $pc
     *
     * @return Fablab
     */
    public function setPC($pc)
    {
        $this->pc = $pc;

        return $this;
    }

    /**
     * Get pc.
     *
     * @return string
     */
    public function getPc()
    {
        return $this->pc;
    }
}
