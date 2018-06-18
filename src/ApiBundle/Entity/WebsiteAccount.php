<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * WebsiteAccount
 *
 * @ORM\Table(name="website_account")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\WebsiteAccountRepository")
 */
class WebsiteAccount
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
     * @ORM\Column(name="account_url", type="string", length=255)
     */
    private $account_url;

    /**
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\User")
     */
    private $owner;

    /**
     * @Groups({"usersprofile"})
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Website")
     */
    private $website;

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
     * Set owner.
     *
     * @param \ApiBundle\Entity\User|null $owner
     *
     * @return WebsiteAccount
     */
    public function setOwner(\ApiBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return \ApiBundle\Entity\User|null
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set website.
     *
     * @param \ApiBundle\Entity\Website|null $website
     *
     * @return WebsiteAccount
     */
    public function setWebsite(\ApiBundle\Entity\Website $website = null)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website.
     *
     * @return \ApiBundle\Entity\Website|null
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set accountUrl.
     *
     * @param string $accountUrl
     *
     * @return WebsiteAccount
     */
    public function setAccountUrl($accountUrl)
    {
        $this->account_url = $accountUrl;

        return $this;
    }

    /**
     * Get accountUrl.
     *
     * @return string
     */
    public function getAccountUrl()
    {
        return $this->account_url;
    }
}
