<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Base_prix
 *
 * @ORM\Table(name="base_prix")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\Base_prixRepository")
 */
class Base_prix
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
     * @ORM\OneToMany(targetEntity="Logement", mappedBy="base_prix")
     */
    private $logement;

    public function __construct() {
        $this->logement = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal")
     */
    private $prix;

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
     * @return Base_prix
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
     * @return Base_prix
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
     * @return Base_prix
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
     * Add logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     *
     * @return Base_prix
     */
    public function addLogement(\Cnccv\HouseBundle\Entity\Logement $logement)
    {
        $this->logement[] = $logement;

        return $this;
    }

    /**
     * Remove logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     */
    public function removeLogement(\Cnccv\HouseBundle\Entity\Logement $logement)
    {
        $this->logement->removeElement($logement);
    }

    /**
     * Get logement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogement()
    {
        return $this->logement;
    }
}
