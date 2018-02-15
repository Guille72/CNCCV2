<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;

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
    protected $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Logement")
     * @ORM\JoinColumn(name="logement_id", referencedColumnName="id")
     */
    protected $logement_id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Parametres_prix")
     * @ORM\JoinColumn(name="parametres_prix_id", referencedColumnName="id")
     */
    protected $parametres_prix_id;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /*
     * @var \DateTime
     * @ORM\Column(name="start_date" type="date")
     */
    public $start_date;

    /*
     * @var \DateTime
     * @ORM\Column(name="end_date" type="date")
     */
    public $end_date;

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

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Booking
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Booking
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set start_date
     *
     * @param \DateTime $start_date
     *
     * @return Booking
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }


    /**
     * Set logementId
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logementId
     *
     * @return Booking
     */
    public function setLogementId(\Cnccv\HouseBundle\Entity\Logement $logementId = null)
    {
        $this->logement_id = $logementId;

        return $this;
    }

    /**
     * Get logementId
     *
     * @return \Cnccv\HouseBundle\Entity\Logement
     */
    public function getLogementId()
    {
        return $this->logement_id;
    }

    /**
     * Set userId
     *
     * @param \Cnccv\HouseBundle\Entity\User $userId
     *
     * @return Booking
     */
    public function setUserId(\Cnccv\HouseBundle\Entity\User $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Cnccv\HouseBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set parametresPrixId
     *
     * @param \Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrixId
     *
     * @return Booking
     */
    public function setParametresPrixId(\Cnccv\HouseBundle\Entity\Parametres_prix $parametresPrixId = null)
    {
        $this->parametres_prix_id = $parametresPrixId;

        return $this;
    }

    /**
     * Get parametresPrixId
     *
     * @return \Cnccv\HouseBundle\Entity\Parametres_prix
     */
    public function getParametresPrixId()
    {
        return $this->parametres_prix_id;
    }
}
