<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * UsersFablab
 *
 * @ORM\Table(name="users_fablab")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UsersFablabRepository")
 */
class UsersFablab
{
    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Fablab", inversedBy="fablab")
     * @Groups({"user"})
     */
    private $fablab;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user")
     * @Groups({"fablab"})
     */
    private $user;

    /**
     * @var date
     *
     * @ORM\Column(name="joined_at", type="date", options={"default" = "now()"})
     * @Groups({"user","fablab"})
     */
    private $joined_at;

    /**
     * Set joinedAt.
     *
     * @param \DateTime $joinedAt
     *
     * @return UsersFablab
     */
    public function setJoinedAt($joinedAt)
    {
        $this->joined_at = $joinedAt;

        return $this;
    }

    /**
     * Get joinedAt.
     *
     * @return \DateTime
     */
    public function getJoinedAt()
    {
        return $this->joined_at;
    }

    /**
     * Set fablab.
     *
     * @param \ApiBundle\Entity\Fablab $fablab
     *
     * @return UsersFablab
     */
    public function setFablab(\ApiBundle\Entity\Fablab $fablab)
    {
        $this->fablab = $fablab;

        return $this;
    }

    /**
     * Get fablab.
     *
     * @return \ApiBundle\Entity\Fablab
     */
    public function getFablab()
    {
        return $this->fablab;
    }

    /**
     * Set user.
     *
     * @param \ApiBundle\Entity\User $user
     *
     * @return UsersFablab
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
}
