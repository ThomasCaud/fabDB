<?php

namespace ApiBundle\Entity;

use ApiBundle\Entity\UsersFablab;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;

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
     * @Groups({"common"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Groups({"common"})
     * @ORM\Column(name="fname", type="string", length=255)
     */
    protected $fname;

    /**
     * @var string
     * @Groups({"common"})
     * @ORM\Column(name="lname", type="string", length=255)
     */
    protected $lname;

    /**
     * @var string
     * @Groups({"common"})
     * @ORM\Column(name="email", nullable=true, type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     * @Groups({"common"})
     * @ORM\Column(name="login", type="string", unique=true)
     */
    private $login;

    /**
     * @Groups({"usersprofile","userscommunication","marketplace"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\UsersFablab", mappedBy="user")
     */
    private $usersFablabs;

    /**
     * @Groups({"connectedobjects"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Access", mappedBy="user")
     */
    private $access;

    /**
     * @var float
     * @Groups({"marketplace","blockchain","userscommunication"})
     * @ORM\Column(name="note", type="float", options={"default":0.0}, nullable=true)
     */
    private $note;

    /**
     * @var int
     * @Groups({"marketplace","userscommunication"})
     * @ORM\Column(name="current_reward_points", type="integer", options={"default":0}, nullable=true)
     */
    private $current_reward_points;

    /**
     * @var int
     * @Groups({"marketplace","userscommunication"})
     * @ORM\Column(name="total_reward_points", type="integer", options={"default":0}, nullable=true)
     */
    private $total_reward_points;

    /**
     * @Groups({"marketplace"})
     * @MaxDepth(1)
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Product", cascade={"persist", "remove"}, mappedBy="maker")
     */
    protected $productsCreated;

    /**
     * @var string|null
     * @Groups({"blockchain"})
     * @ORM\Column(name="wallet_address", type="string", length=150, nullable=true, unique=true)
     */
    protected $wallet_address;

    /**
     * @var string|null
     * @Groups({"blockchain"})
     * @ORM\Column(name="private_key", type="string", length=150, nullable=true)
     */
    protected $private_key;

    /**
     * @var string|null
     * @Groups({"marketplace"})
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @Groups({"marketplace"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Command", cascade={"persist", "remove"}, mappedBy="purchaser")
     */
    protected $commands;

    /**
     * @var string|null
     * @Groups({"userscommunication","usersprofile","blockchain","userskills"})
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    protected $photo;

    /**
     * @var \Date
     * @Groups({"userscommunication","usersprofile","blockchain"})
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     * @Groups({"userscommunication","usersprofile","blockchain"})
     * @ORM\Column(name="sexe", type="string", columnDefinition="ENUM('M','F','O')", nullable=true)
     */
    private $sexe;

    /**
     * @var string
     * @Groups({"userscommunication","usersprofile","blockchain"})
     * @ORM\Column(name="marital_status", type="string", columnDefinition="ENUM('married','widowed','separated', 'divorced','single')", nullable=true)
     */
    private $marital_status;

    /**
     * @var string|null
     * @Groups({"userscommunication","usersprofile","blockchain"})
     * @ORM\Column(name="quote", type="string", nullable=true)
     */
    private $quote;

    /**
     * @var string|null
     * @Groups({"userscommunication","usersprofile","blockchain"})
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var int
     * @Groups({"marketplace","blockchain"})
     * @ORM\Column(name="money", type="integer", length=1, options={"default":0}, nullable=true)
     */
    private $money;

    /**
     * @Groups({"usersprofile"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\FamilyMember", cascade={"persist", "remove"}, mappedBy="referrer")
     */
    protected $familyMembers;

    /** 
     * @Groups({"usersprofile"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\WebsiteAccount", cascade={"persist", "remove"}, mappedBy="owner")
     */
    protected $website_accounts;

    /**
     * @Groups({"usersprofile"})
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Portrait", cascade={"persist"})
     */
    private $portrait;

    /**
     * @Groups({"usersprofile"})
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Motivation", cascade={"persist"})
     */
    private $motivation;

    /**
     * @Groups({"usersprofile","userscommunication"})
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Personnality", cascade={"persist"})
     */
    private $personnality;

    /**
     * @Groups({"userskills"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\UserSkill", mappedBy="user")
     */
    private $skills;

    /**
     * @Groups({"userscommunication"})
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\Position", cascade={"persist"})
     */
    private $position;

    /**
     * @Groups({"userscommunication"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Message", mappedBy="to")
     */
    private $received_messages;

    /**
     * @Groups({"userscommunication"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Message", mappedBy="from")
     */
    private $sent_messages;

    /**
     * @Groups({"userscommunication"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Friend", mappedBy="user_a")
     */
    private $followings;

    /**
     * @Groups({"userscommunication"})
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\Friend", mappedBy="user_b")
     */
    private $followers;

    /**
     * @var int
     * @Groups({"userscommunication"})
     * @ORM\Column(name="glenhs", type="integer", length=1, options={"default":0}, nullable=true)
     */
    private $glenhs;

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

    /**
     * Add websiteAccount.
     *
     * @param \ApiBundle\Entity\WebsiteAccount $websiteAccount
     *
     * @return User
     */
    public function addWebsiteAccount(\ApiBundle\Entity\WebsiteAccount $websiteAccount)
    {
        $this->website_accounts[] = $websiteAccount;

        return $this;
    }

    /**
     * Remove websiteAccount.
     *
     * @param \ApiBundle\Entity\WebsiteAccount $websiteAccount
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWebsiteAccount(\ApiBundle\Entity\WebsiteAccount $websiteAccount)
    {
        return $this->website_accounts->removeElement($websiteAccount);
    }

    /**
     * Get websiteAccounts.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWebsiteAccounts()
    {
        return $this->website_accounts;
    }

    /**
     * Set portrait.
     *
     * @param \ApiBundle\Entity\Portrait|null $portrait
     *
     * @return User
     */
    public function setPortrait(\ApiBundle\Entity\Portrait $portrait = null)
    {
        $this->portrait = $portrait;

        return $this;
    }

    /**
     * Get portrait.
     *
     * @return \ApiBundle\Entity\Portrait|null
     */
    public function getPortrait()
    {
        return $this->portrait;
    }

    /**
     * Set privateKey.
     *
     * @param string|null $privateKey
     *
     * @return User
     */
    public function setPrivateKey($privateKey = null)
    {
        $this->private_key = $privateKey;

        return $this;
    }

    /**
     * Get privateKey.
     *
     * @return string|null
     */
    public function getPrivateKey()
    {
        return $this->private_key;
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
        $this->wallet_address = $walletAddress;

        return $this;
    }

    /**
     * Get walletAddress.
     *
     * @return string|null
     */
    public function getWalletAddress()
    {
        return $this->wallet_address;
    }

    /**
     * Set motivation.
     *
     * @param \ApiBundle\Entity\Motivation|null $motivation
     *
     * @return User
     */
    public function setMotivation(\ApiBundle\Entity\Motivation $motivation = null)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get motivation.
     *
     * @return \ApiBundle\Entity\Motivation|null
     */
    public function getMotivation()
    {
        return $this->motivation;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime|null $birthday
     *
     * @return User
     */
    public function setBirthday($birthday = null)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime|null
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set personnality.
     *
     * @param \ApiBundle\Entity\Personnality|null $personnality
     *
     * @return User
     */
    public function setPersonnality(\ApiBundle\Entity\Personnality $personnality = null)
    {
        $this->personnality = $personnality;

        return $this;
    }

    /**
     * Get personnality.
     *
     * @return \ApiBundle\Entity\Personnality|null
     */
    public function getPersonnality()
    {
        return $this->personnality;
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
        $this->current_reward_points = $currentRewardPoints;

        return $this;
    }

    /**
     * Get currentRewardPoints.
     *
     * @return int
     */
    public function getCurrentRewardPoints()
    {
        return $this->current_reward_points;
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
        $this->total_reward_points = $totalRewardPoints;

        return $this;
    }

    /**
     * Get totalRewardPoints.
     *
     * @return int
     */
    public function getTotalRewardPoints()
    {
        return $this->total_reward_points;
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
        $this->marital_status = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus.
     *
     * @return string|null
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * Add skill.
     *
     * @param \ApiBundle\Entity\UserSkill $skill
     *
     * @return User
     */
    public function addSkill(\ApiBundle\Entity\UserSkill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill.
     *
     * @param \ApiBundle\Entity\UserSkill $skill
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSkill(\ApiBundle\Entity\UserSkill $skill)
    {
        return $this->skills->removeElement($skill);
    }

    /**
     * Get skills.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set position.
     *
     * @param \ApiBundle\Entity\Position|null $position
     *
     * @return User
     */
    public function setPosition(\ApiBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return \ApiBundle\Entity\Position|null
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add receivedMessage.
     *
     * @param \ApiBundle\Entity\Message $receivedMessage
     *
     * @return User
     */
    public function addReceivedMessage(\ApiBundle\Entity\Message $receivedMessage)
    {
        $this->received_messages[] = $receivedMessage;

        return $this;
    }

    /**
     * Remove receivedMessage.
     *
     * @param \ApiBundle\Entity\Message $receivedMessage
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReceivedMessage(\ApiBundle\Entity\Message $receivedMessage)
    {
        return $this->received_messages->removeElement($receivedMessage);
    }

    /**
     * Get receivedMessages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReceivedMessages()
    {
        return $this->received_messages;
    }

    /**
     * Add sentMessage.
     *
     * @param \ApiBundle\Entity\Message $sentMessage
     *
     * @return User
     */
    public function addSentMessage(\ApiBundle\Entity\Message $sentMessage)
    {
        $this->sent_messages[] = $sentMessage;

        return $this;
    }

    /**
     * Remove sentMessage.
     *
     * @param \ApiBundle\Entity\Message $sentMessage
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSentMessage(\ApiBundle\Entity\Message $sentMessage)
    {
        return $this->sent_messages->removeElement($sentMessage);
    }

    /**
     * Get sentMessages.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSentMessages()
    {
        return $this->sent_messages;
    }

    /**
     * Add following.
     *
     * @param \ApiBundle\Entity\Friend $following
     *
     * @return User
     */
    public function addFollowing(\ApiBundle\Entity\Friend $following)
    {
        $this->followings[] = $following;

        return $this;
    }

    /**
     * Remove following.
     *
     * @param \ApiBundle\Entity\Friend $following
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFollowing(\ApiBundle\Entity\Friend $following)
    {
        return $this->followings->removeElement($following);
    }

    /**
     * Get followings.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowings()
    {
        return $this->followings;
    }

    /**
     * Add follower.
     *
     * @param \ApiBundle\Entity\Friend $follower
     *
     * @return User
     */
    public function addFollower(\ApiBundle\Entity\Friend $follower)
    {
        $this->followers[] = $follower;

        return $this;
    }

    /**
     * Remove follower.
     *
     * @param \ApiBundle\Entity\Friend $follower
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFollower(\ApiBundle\Entity\Friend $follower)
    {
        return $this->followers->removeElement($follower);
    }

    /**
     * Get followers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Set glenhs.
     *
     * @param int|null $glenhs
     *
     * @return User
     */
    public function setGlenhs($glenhs = null)
    {
        $this->glenhs = $glenhs;

        return $this;
    }

    /**
     * Get glenhs.
     *
     * @return int|null
     */
    public function getGlenhs()
    {
        return $this->glenhs;
    }
}
