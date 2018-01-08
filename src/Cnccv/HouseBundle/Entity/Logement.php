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
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Booking")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Note")
     * @ORM\JoinColumn(nullable=false)
     */
    private $note;

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
     * @ORM\Column(name="nom", type="string")
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string")
     */
    private $adresse;

    /**
     * @var string
     * @ORM\Column(name="localisation", type="string")
     */
    private $localisation;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string")
     */
    private $ville;

    /**
     * @var string
     * @ORM\Column(name="image", type="string")
     */
    private $image;

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

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Logement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function setNote(Note $note)
    {
        $this->note = $note;
        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;
        return $this;
    }

    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Logement
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Logement
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
