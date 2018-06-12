<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * FamilyMember
 *
 * @ORM\Table(name="family_member")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\FamilyMemberRepository")
 */
class FamilyMember
{
    /**
     * @var int
     * @Groups({"familyMember","user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @Groups({"familyMember"})
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var string
     * @Groups({"familyMember"})
     * @ORM\Column(name="relationship", type="string", columnDefinition="ENUM('son','daughter','father','mother','other')")
     */
    private $relationship;

    /**
     * @var string
     * @Groups({"familyMember"})
     * @ORM\Column(name="sexe", type="string", columnDefinition="ENUM('M','F','O')")
     */
    private $sexe;

    /**
     * @Groups({"familyMember"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     * @ORM\JoinColumn(name="referrer_id", referencedColumnName="id", nullable=false)
     */
    private $referrer;

    /**
     * @Groups({"familyMember"})
     * @ORM\OneToOne(targetEntity="ApiBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_account_id", referencedColumnName="id", nullable=true)
     */
    private $user_account;

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
     * Set relationship.
     *
     * @param string $relationship
     *
     * @return FamilyMember
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;

        return $this;
    }

    /**
     * Get relationship.
     *
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Set sexe.
     *
     * @param string $sexe
     *
     * @return FamilyMember
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe.
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set referrer.
     *
     * @param \ApiBundle\Entity\User|null $referrer
     *
     * @return FamilyMember
     */
    public function setReferrer(\ApiBundle\Entity\User $referrer = null)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set userAccount.
     *
     * @param \ApiBundle\Entity\User|null $userAccount
     *
     * @return FamilyMember
     */
    public function setUserAccount(\ApiBundle\Entity\User $userAccount = null)
    {
        $this->user_account = $userAccount;

        return $this;
    }

    /**
     * Get userAccount.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getUserAccount()
    {
        return $this->user_account;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return FamilyMember
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
}
