<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametres_prix
 * @ORM\Table(name="parametres_prix")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\Parametres_prixRepository")
 */
class Parametres_prix
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Booking")
     * @ORM\JoinColumn(nullable=true)
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Evenement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $evenement;

    /**
     * @var int
     * @ORM\Column(name="jour_annulable", type="integer")
     */
    private $jourAnnulable;

    /**
     * @var int
     * @ORM\Column(name="jour_non_annulable", type="integer")
     */
    private $jourNonAnnulable;

    /**
     * @var string
     * @ORM\Column(name="penalite_annulation_tardive", type="decimal", precision=10, scale=0)
     */
    private $penaliteAnnulationTardive;

    /**
     * @var string
     * @ORM\Column(name="remise_semaine", type="decimal", precision=10, scale=0)
     */
    private $remiseSemaine;

    /**
     * @var string
     * @ORM\Column(name="remise_mois", type="decimal", precision=10, scale=0)
     */
    private $remiseMois;

    /**
     * @var string
     * @ORM\Column(name="prixDef", type="decimal", precision=10, scale=0)
     */
    private $prixDef;

    /**
     * @var string
     * @ORM\Column(name="minimum_facture", type="decimal", precision=10, scale=0)
     */
    private $minimumFacture;

    /**
     * @var string
     * @ORM\Column(name="coef_perso_supp", type="decimal", precision=10, scale=0)
     */
    private $coefPersoSupp;

    /**
     * @var string
     * @ORM\Column(name="forfait_menage_ttc", type="decimal", precision=10, scale=0)
     */
    private $forfaitMenageTtc;

    /**
     * @var int
     * @ORM\Column(name="jours_menage", type="integer")
     */
    private $joursMenage;

    /**
     * @var string
     * @ORM\Column(name="taxe_sejour", type="decimal", precision=10, scale=0)
     */
    private $taxeSejour;

    /**
     * @var string
     * @ORM\Column(name="tva", type="decimal", precision=10, scale=0)
     */
    private $tva;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string")
     */
    private $ville;

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jourAnnulable
     * @param integer $jourAnnulable
     * @return Parametres_prix
     */
    public function setJourAnnulable($jourAnnulable)
    {
        $this->jourAnnulable = $jourAnnulable;
        return $this;
    }

    /**
     * Get jourAnnulable
     * @return int
     */
    public function getJourAnnulable()
    {
        return $this->jourAnnulable;
    }

    /**
     * Set jourNonAnnulable
     * @param integer $jourNonAnnulable
     * @return Parametres_prix
     */
    public function setJourNonAnnulable($jourNonAnnulable)
    {
        $this->jourNonAnnulable = $jourNonAnnulable;
        return $this;
    }

    /**
     * Get jourNonAnnulable
     * @return int
     */
    public function getJourNonAnnulable()
    {
        return $this->jourNonAnnulable;
    }

    /**
     * Set penaliteAnnulationTardive
     * @param string $penaliteAnnulationTardive
     * @return Parametres_prix
     */
    public function setPenaliteAnnulationTardive($penaliteAnnulationTardive)
    {
        $this->penaliteAnnulationTardive = $penaliteAnnulationTardive;
        return $this;
    }

    /**
     * Get penaliteAnnulationTardive
     * @return string
     */
    public function getPenaliteAnnulationTardive()
    {
        return $this->penaliteAnnulationTardive;
    }

    /**
     * Set remiseSemaine
     * @param string $remiseSemaine
     * @return Parametres_prix
     */
    public function setRemiseSemaine($remiseSemaine)
    {
        $this->remiseSemaine = $remiseSemaine;
        return $this;
    }

    /**
     * Get remiseSemaine
     * @return string
     */
    public function getRemiseSemaine()
    {
        return $this->remiseSemaine;
    }

    /**
     * Set remiseMois
     * @param string $remiseMois
     * @return Parametres_prix
     */
    public function setRemiseMois($remiseMois)
    {
        $this->remiseMois = $remiseMois;
        return $this;
    }

    /**
     * Get remiseMois
     * @return string
     */
    public function getRemiseMois()
    {
        return $this->remiseMois;
    }

    /**
     * Set minimumFacture
     * @param string $minimumFacture
     * @return Parametres_prix
     */
    public function setMinimumFacture($minimumFacture)
    {
        $this->minimumFacture = $minimumFacture;
        return $this;
    }

    /**
     * Get minimumFacture
     * @return string
     */
    public function getMinimumFacture()
    {
        return $this->minimumFacture;
    }

    /**
     * Set coefPersoSupp
     * @param string $coefPersoSupp
     * @return Parametres_prix
     */
    public function setCoefPersoSupp($coefPersoSupp)
    {
        $this->coefPersoSupp = $coefPersoSupp;
        return $this;
    }

    /**
     * Get coefPersoSupp
     * @return string
     */
    public function getCoefPersoSupp()
    {
        return $this->coefPersoSupp;
    }

    /**
     * Set forfaitMenageTtc
     * @param string $forfaitMenageTtc
     * @return Parametres_prix
     */
    public function setForfaitMenageTtc($forfaitMenageTtc)
    {
        $this->forfaitMenageTtc = $forfaitMenageTtc;
        return $this;
    }

    /**
     * Get forfaitMenageTtc
     * @return string
     */
    public function getForfaitMenageTtc()
    {
        return $this->forfaitMenageTtc;
    }

    /**
     * Set joursMenage
     * @param integer $joursMenage
     * @return Parametres_prix
     */
    public function setJoursMenage($joursMenage)
    {
        $this->joursMenage = $joursMenage;
        return $this;
    }

    /**
     * Get joursMenage
     * @return int
     */
    public function getJoursMenage()
    {
        return $this->joursMenage;
    }

    /**
     * Set taxeSejour
     * @param string $taxeSejour
     * @return Parametres_prix
     */
    public function setTaxeSejour($taxeSejour)
    {
        $this->taxeSejour = $taxeSejour;
        return $this;
    }

    /**
     * Get taxeSejour
     * @return string
     */
    public function getTaxeSejour()
    {
        return $this->taxeSejour;
    }

    /**
     * Set tva
     * @param string $tva
     * @return Parametres_prix
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
        return $this;
    }

    /**
     * Get tva
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
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
     * Set prixDef
     * @param string $prixDef
     * @return Parametres_prix
     */
    public function setPrixDef($prixDef)
    {
        $this->prixDef = $prixDef;
        return $this;
    }

    /**
     * Get prixDef
     * @return string
     */
    public function getPrixDef()
    {
        return $this->prixDef;
    }

    public function setEvenement(Evenement $evenement)
    {
        $this->evenement = $evenement;
        return $this;
    }

    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Parametres_prix
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
}
