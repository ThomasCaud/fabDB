<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Fablab
 *
 * @ORM\Table(name="fablab")
 * @ORM\Entity
 */
class Fablab
{
    /**
     * @var int
     * @Groups({"user","fablab"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="PC", type="string", length=255)
     */
    private $pc;

    /**
     * @Groups({"fablab"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\UsersFablab", mappedBy="fablab")
     */
    private $users;

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
     * Set address.
     *
     * @param string $address
     *
     * @return Fablab
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set pc.
     *
     * @param string $pc
     *
     * @return Fablab
     */
    public function setPC($pc)
    {
        $this->pc = $pc;

        return $this;
    }

    /**
     * Get pc.
     *
     * @return string
     */
    public function getPc()
    {
        return $this->pc;
    }

    private function userIsIn(User $user)
    {
        return $user->getFablabs()->exists($this);
    }

    public function addUser(User $user)
    {
        $this->users[] = $user;

        if(!userIsIn($user)) {
            $user->addFablab($this);
        }

      return $this;
    }
  
    public function removeUser(User $user)
    {
      $this->users->removeElement($user);
    }
  
    public function getUsers()
    {
      return $this->users;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
