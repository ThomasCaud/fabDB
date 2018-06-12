<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Friend
 *
 * @ORM\Table(name="friend")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\FriendRepository")
 */
class Friend
{
    /**
     * @var int
     * @Groups({"user","friend"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups({"user","friend"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user_a", cascade="persist")
     */
    private $user_a;

    /**
     * @Groups({"user","friend"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user_b", cascade="persist")
     */
    private $user_b;

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
     * Set userA.
     *
     * @param \ApiBundle\Entity\User|null $userA
     *
     * @return Friend
     */
    public function setUserA(\ApiBundle\Entity\User $userA = null)
    {
        $this->user_a = $userA;

        return $this;
    }

    /**
     * Get userA.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getUserA()
    {
        return $this->user_a;
    }

    /**
     * Set userB.
     *
     * @param \ApiBundle\Entity\User|null $userB
     *
     * @return Friend
     */
    public function setUserB(\ApiBundle\Entity\User $userB = null)
    {
        $this->user_b = $userB;

        return $this;
    }

    /**
     * Get userB.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getUserB()
    {
        return $this->user_b;
    }
}
