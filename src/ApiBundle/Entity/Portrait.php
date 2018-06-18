<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Portrait
 *
 * @ORM\Table(name="portrait")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PortraitRepository")
 */
class Portrait
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
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="about_me", type="string", length=255, nullable=true)
     */
    private $aboutMe;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="goal", type="string", length=255, nullable=true)
     */
    private $goal;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="fear", type="string", length=255, nullable=true)
     */
    private $fear;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="challenge", type="string", length=255, nullable=true)
     */
    private $challenge;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="frustration", type="string", length=255, nullable=true)
     */
    private $frustration;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="hobby", type="string", length=255, nullable=true)
     */
    private $hobby;

    /**
     * @var string|null
     * @Groups({"usersprofile"})
     * @ORM\Column(name="other", type="string", length=255, nullable=true)
     */
    private $other;


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
     * Set aboutMe.
     *
     * @param string|null $aboutMe
     *
     * @return Portrait
     */
    public function setAboutMe($aboutMe = null)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * Get aboutMe.
     *
     * @return string|null
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * Set goal.
     *
     * @param string|null $goal
     *
     * @return Portrait
     */
    public function setGoal($goal = null)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal.
     *
     * @return string|null
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set fear.
     *
     * @param string|null $fear
     *
     * @return Portrait
     */
    public function setFear($fear = null)
    {
        $this->fear = $fear;

        return $this;
    }

    /**
     * Get fear.
     *
     * @return string|null
     */
    public function getFear()
    {
        return $this->fear;
    }

    /**
     * Set challenge.
     *
     * @param string|null $challenge
     *
     * @return Portrait
     */
    public function setChallenge($challenge = null)
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * Get challenge.
     *
     * @return string|null
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * Set frustration.
     *
     * @param string|null $frustration
     *
     * @return Portrait
     */
    public function setFrustration($frustration = null)
    {
        $this->frustration = $frustration;

        return $this;
    }

    /**
     * Get frustration.
     *
     * @return string|null
     */
    public function getFrustration()
    {
        return $this->frustration;
    }

    /**
     * Set hobby.
     *
     * @param string|null $hobby
     *
     * @return Portrait
     */
    public function setHobby($hobby = null)
    {
        $this->hobby = $hobby;

        return $this;
    }

    /**
     * Get hobby.
     *
     * @return string|null
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * Set other.
     *
     * @param string|null $other
     *
     * @return Portrait
     */
    public function setOther($other = null)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get other.
     *
     * @return string|null
     */
    public function getOther()
    {
        return $this->other;
    }
}
