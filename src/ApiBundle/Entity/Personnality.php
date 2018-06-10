<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Personnality
 *
 * @ORM\Table(name="personnality")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PersonnalityRepository")
 */
class Personnality
{
    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="mind", type="integer")
     */
    private $mind;

    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="energy", type="integer")
     */
    private $energy;

    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="nature", type="integer")
     */
    private $nature;

    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="tactical", type="integer")
     */
    private $tactical;

    /**
     * @var int
     * @Groups({"personnality","user"})
     * @ORM\Column(name="identity", type="integer")
     */
    private $identity;

    /**
     * @var string
     * @Groups({"personnality","user"})
     * @ORM\Column(name="profil", type="string", columnDefinition="ENUM('analyst','diplomat','explorer','sentinel')", nullable=false)
     */
    private $profil;

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
     * Set mind.
     *
     * @param int $mind
     *
     * @return Personnality
     */
    public function setMind($mind)
    {
        $this->mind = $mind;

        return $this;
    }

    /**
     * Get mind.
     *
     * @return int
     */
    public function getMind()
    {
        return $this->mind;
    }

    /**
     * Set energy.
     *
     * @param int $energy
     *
     * @return Personnality
     */
    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }

    /**
     * Get energy.
     *
     * @return int
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Set nature.
     *
     * @param int $nature
     *
     * @return Personnality
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature.
     *
     * @return int
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set tactical.
     *
     * @param int $tactical
     *
     * @return Personnality
     */
    public function setTactical($tactical)
    {
        $this->tactical = $tactical;

        return $this;
    }

    /**
     * Get tactical.
     *
     * @return int
     */
    public function getTactical()
    {
        return $this->tactical;
    }

    /**
     * Set identity.
     *
     * @param int $identity
     *
     * @return Personnality
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }

    /**
     * Get identity.
     *
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Set profil.
     *
     * @param string $profil
     *
     * @return Personnality
     */
    public function setProfil($profil)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil.
     *
     * @return string
     */
    public function getProfil()
    {
        return $this->profil;
    }
}
