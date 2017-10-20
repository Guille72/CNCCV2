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
     * @var string
     *
     * @ORM\Column(name="coefPrix", type="decimal")
     */
    private $coefPrix;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string")
     */
    private $adresse;

    /**
     * @var boolean
     * @ORM\Column(name="poele", type="boolean")
     */
    private $poele;

    /**
     * @var string
     * @ORM\Column(name="localisation", type="string")
     */
    private $localisation;

    /**
     * @var string
     * @ORM\Column(name="surface", type="string")
     */
    private $surface;

    /**
     * @var string
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="chambres", type="string")
     */
    private $chambres;

    /**
     * @var string
     *
     * @ORM\Column(name="taxe", type="decimal")
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

    /**
     * Set coefPrix
     *
     * @param float $coefPrix
     *
     * @return Logement
     */
    public function setCoefPrix($coefPrix)
    {
        $this->coefPrix = $coefPrix;

        return $this;
    }

    /**
     * Get coefPrix
     *
     * @return float
     */
    public function getCoefPrix()
    {
        return $this->coefPrix;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Logement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set poele
     *
     * @param boolean $poele
     *
     * @return Logement
     */
    public function setPoele($poele)
    {
        $this->poele = $poele;

        return $this;
    }

    /**
     * Get poele
     *
     * @return boolean
     */
    public function getPoele()
    {
        return $this->poele;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Logement
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set surface
     *
     * @param string $surface
     *
     * @return Logement
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return string
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Logement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set chambres
     *
     * @param string $chambres
     *
     * @return Logement
     */
    public function setChambres($chambres)
    {
        $this->chambres = $chambres;

        return $this;
    }

    /**
     * Get chambres
     *
     * @return string
     */
    public function getChambres()
    {
        return $this->chambres;
    }
}
