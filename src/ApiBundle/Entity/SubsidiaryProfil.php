<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * SubsidiaryProfil
 *
 * @ORM\Table(name="subsidiary_profil")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SubsidiaryProfilRepository")
 */
class SubsidiaryProfil
{
    /**
     * @var int
     * @Groups({"subsidiaryProfil","personnality", "user"})
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"subsidiaryProfil","personnality", "user"})
     * @ORM\Column(name="name", type="string", columnDefinition="ENUM('avocat','logicien','architecte','commandant','innovateur','médiateur','protagoniste','inspirateur','logisticien','défenseur','directeur','consul', 'virtuose','aventurier','entrepreneur','amuseur')")
     */
    private $name;

    /**
     * @var string
     * @Groups({"subsidiaryProfil","personnality", "user"})
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     * @Groups({"subsidiaryProfil","personnality", "user"})
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * @return SubsidiaryProfil
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
     * Set logo.
     *
     * @param string $logo
     *
     * @return SubsidiaryProfil
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return SubsidiaryProfil
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
