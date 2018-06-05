<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiBundle\Entity\UsersFablab;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\UsersRepository")
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
     * @var float
     * @Groups({"user","fablab"})
     * @ORM\Column(name="note", type="float", options={"default":0.0})
     */
    private $note;

    /**
     * @var int
     * @Groups({"user","fablab"})
     * @ORM\Column(name="currentRewardPoints", type="integer", options={"default":0})
     */
    private $currentRewardPoints;

    /**
     * @var int
     * @Groups({"user","fablab"})
     * @ORM\Column(name="totalRewardPoints", type="integer", options={"default":0})
     */
    private $totalRewardPoints;

    /**
     * @Groups({"user","fablab"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Product", cascade={"persist", "remove"}, mappedBy="maker")
     */
    protected $productsCreated;

    /**
     * @var string|null
     * @Groups({"user","fablab"})
     * @ORM\Column(name="walletAddress", type="string", length=32, nullable=true)
     */
    protected $walletAddress;

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

    /**
     * Set note.
     *
     * @param float $note
     *
     * @return User
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set currentRewardPoints.
     *
     * @param int $currentRewardPoints
     *
     * @return User
     */
    public function setCurrentRewardPoints($currentRewardPoints)
    {
        $this->currentRewardPoints = $currentRewardPoints;

        return $this;
    }

    /**
     * Get currentRewardPoints.
     *
     * @return int
     */
    public function getCurrentRewardPoints()
    {
        return $this->currentRewardPoints;
    }

    /**
     * Set totalRewardPoints.
     *
     * @param int $totalRewardPoints
     *
     * @return User
     */
    public function setTotalRewardPoints($totalRewardPoints)
    {
        $this->totalRewardPoints = $totalRewardPoints;

        return $this;
    }

    /**
     * Get totalRewardPoints.
     *
     * @return int
     */
    public function getTotalRewardPoints()
    {
        return $this->totalRewardPoints;
    }

    /**
     * Add productsCreated.
     *
     * @param \ApiBundle\Entity\Product $productsCreated
     *
     * @return User
     */
    public function addProductsCreated(\ApiBundle\Entity\Product $productsCreated)
    {
        $this->productsCreated[] = $productsCreated;

        return $this;
    }

    /**
     * Remove productsCreated.
     *
     * @param \ApiBundle\Entity\Product $productsCreated
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProductsCreated(\ApiBundle\Entity\Product $productsCreated)
    {
        return $this->productsCreated->removeElement($productsCreated);
    }

    /**
     * Get productsCreated.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductsCreated()
    {
        return $this->productsCreated;
    }

    /**
     * Set walletAddress.
     *
     * @param string|null $walletAddress
     *
     * @return User
     */
    public function setWalletAddress($walletAddress = null)
    {
        $this->walletAddress = $walletAddress;

        return $this;
    }

    /**
     * Get walletAddress.
     *
     * @return string|null
     */
    public function getWalletAddress()
    {
        return $this->walletAddress;
    }
}
