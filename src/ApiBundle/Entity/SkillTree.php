<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * SkillTree
 *
 * @ORM\Table(name="skill_tree")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SkillTreeRepository")
 */
class SkillTree
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
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Skill", inversedBy="parent", cascade="persist")
     * @Groups({"userskills","userscommunication"})
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Skill", inversedBy="child", cascade="persist")
     * @Groups({"userskills","userscommunication"})
     */
    private $child;

    /**
     * Set parent.
     *
     * @param \ApiBundle\Entity\Skill $parent
     *
     * @return SkillTree
     */
    public function setParent(\ApiBundle\Entity\Skill $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return \ApiBundle\Entity\Skill
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set child.
     *
     * @param \ApiBundle\Entity\Skill $child
     *
     * @return SkillTree
     */
    public function setChild(\ApiBundle\Entity\Skill $child)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child.
     *
     * @return \ApiBundle\Entity\Skill
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
