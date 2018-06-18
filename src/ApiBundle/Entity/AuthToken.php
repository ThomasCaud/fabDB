<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use ApiBundle\Entity\Auth;

/**
 * AuthToken
 *
 * @ORM\Table(name="auth_token")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AuthTokenRepository")
 */
class AuthToken
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"auth"})
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var datetime
     * @Groups({"auth"})
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var Auth
     * @ORM\ManyToOne(targetEntity="Auth")
     */
    private $auth;


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
     * Set value.
     *
     * @param string $value
     *
     * @return AuthToken
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt.
     *
     * @param datetime_immutable $createdAt
     *
     * @return AuthToken
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return datetime_immutable
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getAuth()
    {
        return $this->auth;
    }

    public function setAuth(Auth $auth)
    {
        $this->auth = $auth;
    }
}
