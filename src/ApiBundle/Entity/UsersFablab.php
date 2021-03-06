<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UsersFablab
 *
 * @ORM\Table(name="users_fablab")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UsersFablabRepository")
 */
class UsersFablab
{
    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Fablab", inversedBy="fablab", cascade="persist")
     * @Groups({"marketplace","usersprofile","userscommunication"})
     */
    private $fablab;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user", cascade="persist")
     */
    private $user;

    /**
     * @var date
     *
     * @ORM\Column(name="joined_at", type="date")
     * @Groups({"marketplace","usersprofile","userscommunication"})
     */
    private $joined_at;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", columnDefinition="ENUM('maker','client','admin')")
     * @Groups({"marketplace","usersprofile","userscommunication"})
     */
    private $role = 'client';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('member','secreatery', 'treasurer','president')")
     * @Groups({"marketplace","usersprofile","userscommunication"})
     */
    private $status = 'member';


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

    /**
     * Set role.
     *
     * @param string $role
     *
     * @return UsersFablab
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return UsersFablab
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
