<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
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
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DatePeriod
     *
     * @ORM\Column(name="arrivee", type="date", unique=true)
     */
    private $arrivee;

    /**
     * @var \DatePeriod
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
     * @var string
     *
     * @ORM\Column(name="commentaires", type="string", length=255, nullable=true)
     */
    private $commentaires;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="annulations", type="date", nullable=true)
     */
    private $annulations;

    /**
     * @var float
     *
     * @ORM\Column(name="supplement", type="float", nullable=true)
     */
    private $supplement;

    /**
     * @var float
     *
     * @ORM\Column(name="avoir", type="float", nullable=true)
     */
    private $avoir;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="taxe_sejour", type="float")
     */
    private $taxeSejour;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire_prive", type="string", length=255, nullable=true)
     */
    private $commentairePrive;

    /**
     * @var int
     *
     * @ORM\Column(name="etoile", type="integer", nullable=true)
     */
    private $etoile;

    /**
     * @var int
     *
     * @ORM\Column(name="proprete", type="integer", nullable=true)
     */
    private $proprete;

    /**
     * @var int
     *
     * @ORM\Column(name="accueil", type="integer", nullable=true)
     */
    private $accueil;

    /**
     * @var int
     *
     * @ORM\Column(name="confort", type="integer", nullable=true)
     */
    private $confort;

    /**
     * @var int
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="num_reservation", type="integer")
     */
    private $numReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="calendrier_ext", type="string", length=255, nullable=true, unique=true)
     */
    private $calendrierExt;


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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Reservation
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set arrivee
     *
     * @param \DatePeriod $arrivee
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
     * @return \DatePeriod
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }

    /**
     * Set depart
     *
     * @param \DatePeriod $depart
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
     * @return \DatePeriod
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
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Reservation
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set annulations
     *
     * @param \DateTime $annulations
     *
     * @return Reservation
     */
    public function setAnnulations($annulations)
    {
        $this->annulations = $annulations;

        return $this;
    }

    /**
     * Get annulations
     *
     * @return \DateTime
     */
    public function getAnnulations()
    {
        return $this->annulations;
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Reservation
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
     * Set taxeSejour
     *
     * @param float $taxeSejour
     *
     * @return Reservation
     */
    public function setTaxeSejour($taxeSejour)
    {
        $this->taxeSejour = $taxeSejour;

        return $this;
    }

    /**
     * Get taxeSejour
     *
     * @return float
     */
    public function getTaxeSejour()
    {
        return $this->taxeSejour;
    }

    /**
     * Set commentairePrive
     *
     * @param string $commentairePrive
     *
     * @return Reservation
     */
    public function setCommentairePrive($commentairePrive)
    {
        $this->commentairePrive = $commentairePrive;

        return $this;
    }

    /**
     * Get commentairePrive
     *
     * @return string
     */
    public function getCommentairePrive()
    {
        return $this->commentairePrive;
    }

    /**
     * Set etoile
     *
     * @param integer $etoile
     *
     * @return Reservation
     */
    public function setEtoile($etoile)
    {
        $this->etoile = $etoile;

        return $this;
    }

    /**
     * Get etoile
     *
     * @return int
     */
    public function getEtoile()
    {
        return $this->etoile;
    }

    /**
     * Set proprete
     *
     * @param integer $proprete
     *
     * @return Reservation
     */
    public function setProprete($proprete)
    {
        $this->proprete = $proprete;

        return $this;
    }

    /**
     * Get proprete
     *
     * @return int
     */
    public function getProprete()
    {
        return $this->proprete;
    }

    /**
     * Set accueil
     *
     * @param integer $accueil
     *
     * @return Reservation
     */
    public function setAccueil($accueil)
    {
        $this->accueil = $accueil;

        return $this;
    }

    /**
     * Get accueil
     *
     * @return int
     */
    public function getAccueil()
    {
        return $this->accueil;
    }

    /**
     * Set confort
     *
     * @param integer $confort
     *
     * @return Reservation
     */
    public function setConfort($confort)
    {
        $this->confort = $confort;

        return $this;
    }

    /**
     * Get confort
     *
     * @return int
     */
    public function getConfort()
    {
        return $this->confort;
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
}

