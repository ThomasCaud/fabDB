<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiBundle\Entity\UsersFablab;

/**
 * User
 * 
 * @ORM\Table(name="users") 
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     * @Groups({"user","fablab"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="fname", type="string", length=255)
     */
    protected $fname;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="lname", type="string", length=255)
     */
    protected $lname;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="email", nullable=true, type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * @Groups({"user","fablab"})
     * @ORM\Column(name="login", type="string", unique=true)
     */
    private $login;

    /**
     * @Groups({"user"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\UsersFablab", mappedBy="user")
     */
    private $usersFablabs;

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
     * Set fname.
     *
     * @param string $fname
     *
     * @return User
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname.
     *
     * @return string
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * Set lname.
     *
     * @param string $lname
     *
     * @return User
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname.
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return User
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    private function isInFablab(Fablab $fablab)
    {
        return $fablab->getUsers()->contains($this);
    }
  
    public function removeFablab(Fablab $fablab)
    {
      $this->fablabs->removeElement($fablab);
    }
  
    public function getUsersFablabs()
    {
      return $this->usersFablabs;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fablabs = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add usersFablab.
     *
     * @param \ApiBundle\Entity\UsersFablab $usersFablab
     *
     * @return User
     */
    public function addUsersFablab(\ApiBundle\Entity\UsersFablab $usersFablab)
    {
        $this->usersFablabs[] = $usersFablab;

        return $this;
    }

    /**
     * Remove usersFablab.
     *
     * @param \ApiBundle\Entity\UsersFablab $usersFablab
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUsersFablab(\ApiBundle\Entity\UsersFablab $usersFablab)
    {
        return $this->usersFablabs->removeElement($usersFablab);
    }
}
