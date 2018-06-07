<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @ORM\Column(name="birthDate", type="datetime")
     */
    private $birthDate;

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
    private $userAccount;

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
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return FamilyMember
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
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
}
