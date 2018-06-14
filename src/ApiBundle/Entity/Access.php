<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Access
 *
 * @ORM\Table(name="access")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AccessRepository")
 */
class Access
{
    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User", inversedBy="user", cascade="persist")
     * @Groups({"connectedobjects"})
     */
    private $user;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="ApiBundle\Entity\ConnectedObject", inversedBy="connectedObject", cascade="persist")
     * @Groups({"connectedobjects"})
     */
    private $connectedObject;

    /**
     * @var string
     * @Groups({"connectedobjects"})
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('normal','premium','admin')")
     */
    private $type;

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Access
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user.
     *
     * @param \ApiBundle\Entity\User $user
     *
     * @return Access
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
     * Set connectedObject.
     *
     * @param \ApiBundle\Entity\ConnectedObject $connectedObject
     *
     * @return Access
     */
    public function setConnectedObject(\ApiBundle\Entity\ConnectedObject $connectedObject)
    {
        $this->connectedObject = $connectedObject;

        return $this;
    }

    /**
     * Get connectedObject.
     *
     * @return \ApiBundle\Entity\ConnectedObject
     */
    public function getConnectedObject()
    {
        return $this->connectedObject;
    }
}
