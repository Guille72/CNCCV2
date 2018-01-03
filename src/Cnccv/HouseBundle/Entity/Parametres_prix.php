<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametres_prix
 *
 * @ORM\Table(name="parametres_prix")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\Parametres_prixRepository")
 */
class Parametres_prix
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
     * @ORM\JoinColumn()
     */
    private $logement;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Booking")
     * @ORM\JoinColumn()
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Evenement")
     * @ORM\JoinColumn()
     */
    private $base_prix;

    /**
     * @var int
     *
     * @ORM\Column(name="jour_annulable", type="integer")
     */
    private $jourAnnulable;

    /**
     * @var int
     *
     * @ORM\Column(name="jour_non_annulable", type="integer")
     */
    private $jourNonAnnulable;

    /**
     * @var string
     *
     * @ORM\Column(name="penalite_annulation_tardive", type="decimal", precision=10, scale=0)
     */
    private $penaliteAnnulationTardive;

    /**
     * @var string
     *
     * @ORM\Column(name="remise_semaine", type="decimal", precision=10, scale=0)
     */
    private $remiseSemaine;

    /**
     * @var string
     *
     * @ORM\Column(name="remise_mois", type="decimal", precision=10, scale=0)
     */
    private $remiseMois;

    /**
     * @var string
     *
     * @ORM\Column(name="prixDef", type="decimal", precision=10, scale=0)
     */
    private $prixDef;

    /**
     * @var string
     *
     * @ORM\Column(name="minimum_facture", type="decimal", precision=10, scale=0)
     */
    private $minimumFacture;

    /**
     * @var string
     *
     * @ORM\Column(name="coef_perso_supp", type="decimal", precision=10, scale=0)
     */
    private $coefPersoSupp;

    /**
     * @var string
     *
     * @ORM\Column(name="forfait_menage_ttc", type="decimal", precision=10, scale=0)
     */
    private $forfaitMenageTtc;

    /**
     * @var int
     *
     * @ORM\Column(name="jours_menage", type="integer")
     */
    private $joursMenage;

    /**
     * @var string
     *
     * @ORM\Column(name="taxe_sejour", type="decimal", precision=10, scale=0)
     */
    private $taxeSejour;

    /**
     * @var string
     *
     * @ORM\Column(name="tva", type="decimal", precision=10, scale=0)
     */
    private $tva;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string")
     */
    private $ville;

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
     * Set jourAnnulable
     *
     * @param integer $jourAnnulable
     *
     * @return Parametres_prix
     */
    public function setJourAnnulable($jourAnnulable)
    {
        $this->jourAnnulable = $jourAnnulable;

        return $this;
    }

    /**
     * Get jourAnnulable
     *
     * @return int
     */
    public function getJourAnnulable()
    {
        return $this->jourAnnulable;
    }

    /**
     * Set jourNonAnnulable
     *
     * @param integer $jourNonAnnulable
     *
     * @return Parametres_prix
     */
    public function setJourNonAnnulable($jourNonAnnulable)
    {
        $this->jourNonAnnulable = $jourNonAnnulable;

        return $this;
    }

    /**
     * Get jourNonAnnulable
     *
     * @return int
     */
    public function getJourNonAnnulable()
    {
        return $this->jourNonAnnulable;
    }

    /**
     * Set penaliteAnnulationTardive
     *
     * @param string $penaliteAnnulationTardive
     *
     * @return Parametres_prix
     */
    public function setPenaliteAnnulationTardive($penaliteAnnulationTardive)
    {
        $this->penaliteAnnulationTardive = $penaliteAnnulationTardive;

        return $this;
    }

    /**
     * Get penaliteAnnulationTardive
     *
     * @return string
     */
    public function getPenaliteAnnulationTardive()
    {
        return $this->penaliteAnnulationTardive;
    }

    /**
     * Set remiseSemaine
     *
     * @param string $remiseSemaine
     *
     * @return Parametres_prix
     */
    public function setRemiseSemaine($remiseSemaine)
    {
        $this->remiseSemaine = $remiseSemaine;

        return $this;
    }

    /**
     * Get remiseSemaine
     *
     * @return string
     */
    public function getRemiseSemaine()
    {
        return $this->remiseSemaine;
    }

    /**
     * Set remiseMois
     *
     * @param string $remiseMois
     *
     * @return Parametres_prix
     */
    public function setRemiseMois($remiseMois)
    {
        $this->remiseMois = $remiseMois;

        return $this;
    }

    /**
     * Get remiseMois
     *
     * @return string
     */
    public function getRemiseMois()
    {
        return $this->remiseMois;
    }

    /**
     * Set minimumFacture
     *
     * @param string $minimumFacture
     *
     * @return Parametres_prix
     */
    public function setMinimumFacture($minimumFacture)
    {
        $this->minimumFacture = $minimumFacture;

        return $this;
    }

    /**
     * Get minimumFacture
     *
     * @return string
     */
    public function getMinimumFacture()
    {
        return $this->minimumFacture;
    }

    /**
     * Set coefPersoSupp
     *
     * @param string $coefPersoSupp
     *
     * @return Parametres_prix
     */
    public function setCoefPersoSupp($coefPersoSupp)
    {
        $this->coefPersoSupp = $coefPersoSupp;

        return $this;
    }

    /**
     * Get coefPersoSupp
     *
     * @return string
     */
    public function getCoefPersoSupp()
    {
        return $this->coefPersoSupp;
    }

    /**
     * Set forfaitMenageTtc
     *
     * @param string $forfaitMenageTtc
     *
     * @return Parametres_prix
     */
    public function setForfaitMenageTtc($forfaitMenageTtc)
    {
        $this->forfaitMenageTtc = $forfaitMenageTtc;

        return $this;
    }

    /**
     * Get forfaitMenageTtc
     *
     * @return string
     */
    public function getForfaitMenageTtc()
    {
        return $this->forfaitMenageTtc;
    }

    /**
     * Set joursMenage
     *
     * @param integer $joursMenage
     *
     * @return Parametres_prix
     */
    public function setJoursMenage($joursMenage)
    {
        $this->joursMenage = $joursMenage;

        return $this;
    }

    /**
     * Get joursMenage
     *
     * @return int
     */
    public function getJoursMenage()
    {
        return $this->joursMenage;
    }

    /**
     * Set taxeSejour
     *
     * @param string $taxeSejour
     *
     * @return Parametres_prix
     */
    public function setTaxeSejour($taxeSejour)
    {
        $this->taxeSejour = $taxeSejour;

        return $this;
    }

    /**
     * Get taxeSejour
     *
     * @return string
     */
    public function getTaxeSejour()
    {
        return $this->taxeSejour;
    }

    /**
     * Set tva
     *
     * @param string $tva
     *
     * @return Parametres_prix
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set logement
     *
     * @param \Cnccv\HouseBundle\Entity\Logement $logement
     *
     * @return Parametres_prix
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
     * Set reservation
     *
     * @param \Cnccv\HouseBundle\Entity\Booking $reservation
     *
     * @return Parametres_prix
     */
    public function setReservation(\Cnccv\HouseBundle\Entity\Booking $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Cnccv\HouseBundle\Entity\Booking
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set basePrix
     *
     * @param \Cnccv\HouseBundle\Entity\Evenement $basePrix
     *
     * @return Parametres_prix
     */
    public function setBasePrix(\Cnccv\HouseBundle\Entity\Evenement $basePrix)
    {
        $this->base_prix = $basePrix;

        return $this;
    }

    /**
     * Get basePrix
     *
     * @return \Cnccv\HouseBundle\Entity\Evenement
     */
    public function getBasePrix()
    {
        return $this->base_prix;
    }

    /**
     * Set prixDef
     *
     * @param string $prixDef
     *
     * @return Parametres_prix
     */
    public function setPrixDef($prixDef)
    {
        $this->prixDef = $prixDef;

        return $this;
    }

    /**
     * Get prixDef
     *
     * @return string
     */
    public function getPrixDef()
    {
        return $this->prixDef;
    }
}
