<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Motivation
 *
 * @ORM\Table(name="motivation")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\MotivationRepository")
 */
class Motivation
{
    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="meaning", type="integer")
     */
    private $meaning;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="empowerment", type="integer")
     */
    private $empowerment;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="social_influence", type="integer")
     */
    private $socialInfluence;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="unpredictability", type="integer")
     */
    private $unpredictability;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="avoidance", type="integer")
     */
    private $avoidance;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="scarcity", type="integer")
     */
    private $scarcity;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="ownership", type="integer")
     */
    private $ownership;

    /**
     * @var int
     * @Groups({"usersprofile"})
     * @ORM\Column(name="accomplishment", type="integer")
     */
    private $accomplishment;


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
     * Set meaning.
     *
     * @param int $meaning
     *
     * @return Motivation
     */
    public function setMeaning($meaning)
    {
        $this->meaning = $meaning;

        return $this;
    }

    /**
     * Get meaning.
     *
     * @return int
     */
    public function getMeaning()
    {
        return $this->meaning;
    }

    /**
     * Set empowerment.
     *
     * @param int $empowerment
     *
     * @return Motivation
     */
    public function setEmpowerment($empowerment)
    {
        $this->empowerment = $empowerment;

        return $this;
    }

    /**
     * Get empowerment.
     *
     * @return int
     */
    public function getEmpowerment()
    {
        return $this->empowerment;
    }

    /**
     * Set socialInfluence.
     *
     * @param int $socialInfluence
     *
     * @return Motivation
     */
    public function setSocialInfluence($socialInfluence)
    {
        $this->socialInfluence = $socialInfluence;

        return $this;
    }

    /**
     * Get socialInfluence.
     *
     * @return int
     */
    public function getSocialInfluence()
    {
        return $this->socialInfluence;
    }

    /**
     * Set unpredictability.
     *
     * @param int $unpredictability
     *
     * @return Motivation
     */
    public function setUnpredictability($unpredictability)
    {
        $this->unpredictability = $unpredictability;

        return $this;
    }

    /**
     * Get unpredictability.
     *
     * @return int
     */
    public function getUnpredictability()
    {
        return $this->unpredictability;
    }

    /**
     * Set avoidance.
     *
     * @param int $avoidance
     *
     * @return Motivation
     */
    public function setAvoidance($avoidance)
    {
        $this->avoidance = $avoidance;

        return $this;
    }

    /**
     * Get avoidance.
     *
     * @return int
     */
    public function getAvoidance()
    {
        return $this->avoidance;
    }

    /**
     * Set scarcity.
     *
     * @param int $scarcity
     *
     * @return Motivation
     */
    public function setScarcity($scarcity)
    {
        $this->scarcity = $scarcity;

        return $this;
    }

    /**
     * Get scarcity.
     *
     * @return int
     */
    public function getScarcity()
    {
        return $this->scarcity;
    }

    /**
     * Set ownership.
     *
     * @param int $ownership
     *
     * @return Motivation
     */
    public function setOwnership($ownership)
    {
        $this->ownership = $ownership;

        return $this;
    }

    /**
     * Get ownership.
     *
     * @return int
     */
    public function getOwnership()
    {
        return $this->ownership;
    }

    /**
     * Set accomplishment.
     *
     * @param int $accomplishment
     *
     * @return Motivation
     */
    public function setAccomplishment($accomplishment)
    {
        $this->accomplishment = $accomplishment;

        return $this;
    }

    /**
     * Get accomplishment.
     *
     * @return int
     */
    public function getAccomplishment()
    {
        return $this->accomplishment;
    }
}
