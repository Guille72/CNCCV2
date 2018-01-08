<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", unique=true)
     */
    private $start_date;

    /**
     * @ORM\OneToMany(targetEntity="Cnccv\HouseBundle\Entity\User", mappedBy="note")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="Cnccv\HouseBundle\Entity\Logement", mappedBy="note")
     */
    private $logements;

    /**
     * @ORM\OneToMany(targetEntity="Cnccv\HouseBundle\Entity\Parametres_prix", mappedBy="note")
     */
    private $parametres_prixes;

    /**
     * @ORM\OneToOne(targetEntity="Cnccv\HouseBundle\Entity\Note", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", unique=true)
     */
    private $end_date;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     *
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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
     * @return Booking
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

    public function setNote(note $note = null)
    {
        $this->note = $note;
    }

    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Booking
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Booking
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->logements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parametres_prixes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \Cnccv\HouseBundle\Entity\Users $user
     *
     * @return Booking
     */
    public function addUser(\Cnccv\HouseBundle\Entity\Users $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Cnccv\HouseBundle\Entity\Users $user
     */
    public function removeUser(\Cnccv\HouseBundle\Entity\Users $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     *
     * @return Booking
     */
    public function addLogement(\Cnccv\HouseBundle\Entity\Logement $logement)
    {
        $this->logements[] = $logement;

        return $this;
    }

    /**
     * Remove logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     */
    public function removeLogement(\Cnccv\HouseBundle\Entity\Logement $logement)
    {
        $this->logements->removeElement($logement);
    }

    /**
     * Get logements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLogements()
    {
        return $this->logements;
    }

    /**
     * Add parametresPrix
     *
     * @param \Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrix
     *
     * @return Booking
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
