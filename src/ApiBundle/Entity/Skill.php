<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SkillRepository")
 */
class Skill
{
    /**
     * @var int
     * @Groups({"userskills","userscommunication"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"userskills","userscommunication"})
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     * @Groups({"userskills","userscommunication"})
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Groups({"userskills","userscommunication"})
     * @ORM\Column(name="detail", type="string", length=255)
     */
    private $detail;

    /**
     * @var int
     * @Groups({"userskills","userscommunication"})
     * @ORM\Column(name="level_max", type="integer")
     */
    private $level_max;

    /**
     * @Groups({"userskills","userscommunication"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\SkillTree", mappedBy="parent", cascade={"merge", "persist"}, orphanRemoval=true)
     */
    private $children;

    /**
     * @Groups({"userskills","userscommunication"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\SkillDomain")
     */
    private $domain;

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
     * @return Skill
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
     * Set description.
     *
     * @param string $description
     *
     * @return Skill
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

    /**
     * Set detail.
     *
     * @param string $detail
     *
     * @return Skill
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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set levelMax.
     *
     * @param int $levelMax
     *
     * @return Skill
     */
    public function setLevelMax($levelMax)
    {
        $this->level_max = $levelMax;

        return $this;
    }

    /**
     * Get levelMax.
     *
     * @return int
     */
    public function getLevelMax()
    {
        return $this->level_max;
    }

    /**
     * Add child.
     *
     * @param \ApiBundle\Entity\SkillTree $child
     *
     * @return Skill
     */
    public function addChild(\ApiBundle\Entity\SkillTree $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \ApiBundle\Entity\SkillTree $child
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChild(\ApiBundle\Entity\SkillTree $child)
    {
        return $this->children->removeElement($child);
    }

    /**
     * Get children.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set domain.
     *
     * @param \ApiBundle\Entity\SkillDomain $domain
     *
     * @return Skill
     */
    public function setDomain(\ApiBundle\Entity\SkillDomain $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain.
     *
     * @return \ApiBundle\Entity\SkillDomain
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
