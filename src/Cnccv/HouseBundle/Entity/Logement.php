<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Logement
 *
 * @ORM\Table(name="logement")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\LogementRepository")
 */
class Logement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Base_prix")
     * @ORM\JoinColumn(nullable=false)
     */
    private $base_prix;

    /**
     * @var int
     *
     * @ORM\Column(name="personne_max", type="integer")
     */
    private $personneMax;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="taxe", type="float")
     */
    private $taxe;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set personneMax
     *
     * @param integer $personneMax
     *
     * @return Logement
     */
    public function setPersonneMax($personneMax)
    {
        $this->personneMax = $personneMax;

        return $this;
    }

    /**
     * Get personneMax
     *
     * @return int
     */
    public function getPersonneMax()
    {
        return $this->personneMax;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Logement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set taxe
     *
     * @param float $taxe
     *
     * @return Logement
     */
    public function setTaxe($taxe)
    {
        $this->taxe = $taxe;

        return $this;
    }

    /**
     * Get taxe
     *
     * @return float
     */
    public function getTaxe()
    {
        return $this->taxe;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Logement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set basePrix
     *
     * @param \Cnccv\HouseBundle\Entity\Base_prix $basePrix
     *
     * @return Logement
     */
    public function setBasePrix(\Cnccv\HouseBundle\Entity\Base_prix $basePrix)
    {
        $this->base_prix = $basePrix;

        return $this;
    }

    /**
     * Get basePrix
     *
     * @return \Cnccv\HouseBundle\Entity\Base_prix
     */
    public function getBasePrix()
    {
        return $this->base_prix;
    }
}
