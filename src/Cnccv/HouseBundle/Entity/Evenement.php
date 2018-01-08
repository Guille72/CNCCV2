<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @var string
     *
     * @ORM\Column(name="evenement", type="string")
     */
    private $evenement;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="Cnccv\HouseBundle\Entity\Parametres_prix", mappedBy="note")
     */
    private $parametres_prixes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;


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
     * Set prix
     *
     * @param float $prix
     *
     * @return Evenement
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Evenement
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Evenement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set evenement
     *
     * @param string $evenement
     *
     * @return Evenement
     */
    public function setEvenement($evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return string
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parametres_prixes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parametresPrix
     *
     * @param \Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrix
     *
     * @return Evenement
     */
    public function addParametresPrix(\Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrix)
    {
        $this->parametres_prixes[] = $parametresPrix;

        return $this;
    }

    /**
     * Remove parametresPrix
     *
     * @param \Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrix
     */
    public function removeParametresPrix(\Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrix)
    {
        $this->parametres_prixes->removeElement($parametresPrix);
    }

    /**
     * Get parametresPrixes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParametresPrixes()
    {
        return $this->parametres_prixes;
    }
}
