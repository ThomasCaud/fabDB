<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PositionRepository")
 */
class Position
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     * @Groups({"user"})
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     * @Groups({"user"})
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;


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
     * Set latitude.
     *
     * @param float $latitude
     *
     * @return Position
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude.
     *
     * @param float $longitude
     *
     * @return Position
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }
}
