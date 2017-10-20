<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Logement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $logement;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivee", type="date", unique=true)
     */
    private $arrivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="depart", type="date", unique=true)
     */
    private $depart;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_personne", type="integer")
     */
    private $nbPersonne;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_nuit", type="integer")
     */
    private $nbNuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="annulation", type="date", nullable=true)
     */
    private $annulation;

    /**
     * @var string
     *
     * @ORM\Column(name="supplement", type="decimal", nullable=true)
     */
    private $supplement;

    /**
     * @var string
     *
     * @ORM\Column(name="avoir", type="decimal", nullable=true)
     */
    private $avoir;

    /**
     * @var string
     *
     * @ORM\Column(name="calendrier_ext", type="string", length=255, nullable=true, unique=true)
     */
    private $calendrierExt;

    /**
     * @var int
     *
     * @ORM\Column(name="num_reservation", type="integer", unique=true)
     */
    private $numReservation;


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
     * Set arrivee
     *
     * @param \DateTime $arrivee
     *
     * @return Reservation
     */
    public function setArrivee($arrivee)
    {
        $this->arrivee = $arrivee;

        return $this;
    }

    /**
     * Get arrivee
     *
     * @return \DateTime
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }

    /**
     * Set depart
     *
     * @param \DateTime $depart
     *
     * @return Reservation
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return \DateTime
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     *
     * @return Reservation
     */
    public function setNbPersonne($nbPersonne)
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Get nbPersonne
     *
     * @return int
     */
    public function getNbPersonne()
    {
        return $this->nbPersonne;
    }

    /**
     * Set nbNuit
     *
     * @param integer $nbNuit
     *
     * @return Reservation
     */
    public function setNbNuit($nbNuit)
    {
        $this->nbNuit = $nbNuit;

        return $this;
    }

    /**
     * Get nbNuit
     *
     * @return int
     */
    public function getNbNuit()
    {
        return $this->nbNuit;
    }

    /**
     * Set annulation
     *
     * @param \DateTime $annulation
     *
     * @return Reservation
     */
    public function setAnnulation($annulation)
    {
        $this->annulation = $annulation;

        return $this;
    }

    /**
     * Get annulation
     *
     * @return \DateTime
     */
    public function getAnnulation()
    {
        return $this->annulation;
    }

    /**
     * Set supplement
     *
     * @param float $supplement
     *
     * @return Reservation
     */
    public function setSupplement($supplement)
    {
        $this->supplement = $supplement;

        return $this;
    }

    /**
     * Get supplement
     *
     * @return float
     */
    public function getSupplement()
    {
        return $this->supplement;
    }

    /**
     * Set avoir
     *
     * @param float $avoir
     *
     * @return Reservation
     */
    public function setAvoir($avoir)
    {
        $this->avoir = $avoir;

        return $this;
    }

    /**
     * Get avoir
     *
     * @return float
     */
    public function getAvoir()
    {
        return $this->avoir;
    }

    /**
     * Set calendrierExt
     *
     * @param string $calendrierExt
     *
     * @return Reservation
     */
    public function setCalendrierExt($calendrierExt)
    {
        $this->calendrierExt = $calendrierExt;

        return $this;
    }

    /**
     * Get calendrierExt
     *
     * @return string
     */
    public function getCalendrierExt()
    {
        return $this->calendrierExt;
    }

    /**
     * Set numReservation
     *
     * @param integer $numReservation
     *
     * @return Reservation
     */
    public function setNumReservation($numReservation)
    {
        $this->numReservation = $numReservation;

        return $this;
    }

    /**
     * Get numReservation
     *
     * @return int
     */
    public function getNumReservation()
    {
        return $this->numReservation;
    }

    /**
     * Set logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     *
     * @return Reservation
     */
    public function setLogement(\Cnccv\HouseBundle\Entity\Logement $logement)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * Get logement
     *
     * @return \Cnccv\HouseBundle\Entity\Logement
     */
    public function getLogement()
    {
        return $this->logement;
    }

    /**
     * Set user
     *
     * @param \Cnccv\HouseBundle\Entity\User $user
     *
     * @return Reservation
     */
    public function setUser(\Cnccv\HouseBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Cnccv\HouseBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
