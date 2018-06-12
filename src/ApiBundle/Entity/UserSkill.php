<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UserSkill
 *
 * @ORM\Table(name="user_skill")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UserSkillRepository")
 */
class UserSkill
{
    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user", cascade="persist")
     * @Groups({"skill"})
     */
    private $user;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Skill", inversedBy="skill", cascade="persist")
     * @Groups({"user","skill"})
     */
    private $skill;

    /**
     * @var int
     * @Groups({"skill","user"})
     * @ORM\Column(name="niveau", type="integer")
     */
    private $niveau;

    /**
     * @var \DateTime
     * @Groups({"skill","user"})
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set niveau.
     *
     * @param int $niveau
     *
     * @return UserSkill
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau.
     *
     * @return int
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return UserSkill
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
     * Set user.
     *
     * @param \ApiBundle\Entity\User $user
     *
     * @return UserSkill
     */
    public function setUser(\ApiBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \ApiBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set skill.
     *
     * @param \ApiBundle\Entity\Skill $skill
     *
     * @return UserSkill
     */
    public function setSkill(\ApiBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill.
     *
     * @return \ApiBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
