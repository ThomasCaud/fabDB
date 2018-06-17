<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * SkillDomain
 *
 * @ORM\Table(name="skill_domain")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SkillDomainRepository")
 */
class SkillDomain
{
    /**
     * @var int
     * @Groups({"skill","user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"skill"})
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     * @Groups({"skill"})
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Groups({"skill"})
     * @ORM\Column(name="detail", type="string", length=255)
     */
    private $detail;

    /**
     * @Groups({"skill"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Skill", mappedBy="domain")
     */
    private $skills;

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
     * Set title.
     *
     * @param string $title
     *
     * @return SkillDomain
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set detail.
     *
     * @param string $detail
     *
     * @return SkillDomain
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail.
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return SkillDomain
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
