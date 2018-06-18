<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Website
 *
 * @ORM\Table(name="website")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\WebsiteRepository")
 */
class Website
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
     * @var string
     * @Groups({"usersprofile"})
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     * @Groups({"usersprofile"})
     * @ORM\Column(name="logo_url", type="string", length=255)
     */
    private $logoURL;

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
     * Set name.
     *
     * @param string $name
     *
     * @return Website
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set logoURL.
     *
     * @param string $logoURL
     *
     * @return Website
     */
    public function setLogoURL($logoURL)
    {
        $this->logoURL = $logoURL;

        return $this;
    }

    /**
     * Get logoURL.
     *
     * @return string
     */
    public function getLogoURL()
    {
        return $this->logoURL;
    }
}
