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
     * @Groups({"user","fablab", "command","comment", "access"})
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
     * @Groups({"user"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Access", mappedBy="user")
     */
    private $access;

    /**
     * @var float
     * @Groups({"user"})
     * @ORM\Column(name="note", type="float", options={"default":0.0})
     */
    private $note;

    /**
     * @var int
     * @Groups({"user"})
     * @ORM\Column(name="currentRewardPoints", type="integer", options={"default":0})
     */
    private $currentRewardPoints;

    /**
     * @var int
     * @Groups({"user"})
     * @ORM\Column(name="totalRewardPoints", type="integer", options={"default":0})
     */
    private $totalRewardPoints;

    /**
     * @Groups({"user"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Product", cascade={"persist", "remove"}, mappedBy="maker")
     */
    protected $productsCreated;

    /**
     * @var string|null
     * @Groups({"user"})
     * @ORM\Column(name="walletAddress", type="string", length=32, nullable=true)
     */
    protected $walletAddress;

    /**
     * @var string|null
     * @Groups({"user"})
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @Groups({"all","user"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Command", cascade={"persist", "remove"}, mappedBy="purchaser")
     */
    protected $commands;

    /**
     * @var string|null
     * @Groups({"user"})
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    protected $photo;

    /**
     * @var \DateTime
     * @Groups({"user"})
     * @ORM\Column(name="birthDate", type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     * @Groups({"user"})
     * @ORM\Column(name="sexe", type="string", columnDefinition="ENUM('M','F','O')", nullable=true)
     */
    private $sexe;

    /**
     * @var string
     * @Groups({"user"})
     * @ORM\Column(name="maritalStatus", type="string", columnDefinition="ENUM('married','widowed','separated', 'divorced','single')", nullable=true)
     */
    private $maritalStatus;

    /**
     * @var string|null
     * @Groups({"user"})
     * @ORM\Column(name="quote", type="string", nullable=true)
     */
    private $quote;

    /**
     * @var string|null
     * @Groups({"user"})
     * @ORM\Column(name="biography", type="string", nullable=true)
     */
    private $biography;

    /**
     * @var int
     * @Groups({"user"})
     * @ORM\Column(name="money", type="integer", length=1, options={"default":0})
     */
    private $money;

    /**
     * @Groups({"user"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\FamilyMember", cascade={"persist", "remove"}, mappedBy="referrer")
     */
    protected $familyMembers;

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

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add command.
     *
     * @param \ApiBundle\Entity\Command $command
     *
     * @return User
     */
    public function addCommand(\ApiBundle\Entity\Command $command)
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * Remove command.
     *
     * @param \ApiBundle\Entity\Command $command
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCommand(\ApiBundle\Entity\Command $command)
    {
        return $this->commands->removeElement($command);
    }

    /**
     * Get commands.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Add access.
     *
     * @param \ApiBundle\Entity\Access $access
     *
     * @return User
     */
    public function addAccess(\ApiBundle\Entity\Access $access)
    {
        $this->access[] = $access;

        return $this;
    }

    /**
     * Remove access.
     *
     * @param \ApiBundle\Entity\Access $access
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAccess(\ApiBundle\Entity\Access $access)
    {
        return $this->access->removeElement($access);
    }

    /**
     * Get access.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set photo.
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo.
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime|null $birthDate
     *
     * @return User
     */
    public function setBirthDate($birthDate = null)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime|null
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set sexe.
     *
     * @param string|null $sexe
     *
     * @return User
     */
    public function setSexe($sexe = null)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe.
     *
     * @return string|null
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set maritalStatus.
     *
     * @param string|null $maritalStatus
     *
     * @return User
     */
    public function setMaritalStatus($maritalStatus = null)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus.
     *
     * @return string|null
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set quote.
     *
     * @param string|null $quote
     *
     * @return User
     */
    public function setQuote($quote = null)
    {
        $this->quote = $quote;

        return $this;
    }

    /**
     * Get quote.
     *
     * @return string|null
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * Set biography.
     *
     * @param string|null $biography
     *
     * @return User
     */
    public function setBiography($biography = null)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography.
     *
     * @return string|null
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set money.
     *
     * @param int $money
     *
     * @return User
     */
    public function setMoney($money)
    {
        $this->money = $money;

        return $this;
    }

    /**
     * Get money.
     *
     * @return int
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Add familyMember.
     *
     * @param \ApiBundle\Entity\FamilyMember $familyMember
     *
     * @return User
     */
    public function addFamilyMember(\ApiBundle\Entity\FamilyMember $familyMember)
    {
        $this->familyMembers[] = $familyMember;

        return $this;
    }

    /**
     * Remove familyMember.
     *
     * @param \ApiBundle\Entity\FamilyMember $familyMember
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFamilyMember(\ApiBundle\Entity\FamilyMember $familyMember)
    {
        return $this->familyMembers->removeElement($familyMember);
    }

    /**
     * Get familyMembers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFamilyMembers()
    {
        return $this->familyMembers;
    }
}
