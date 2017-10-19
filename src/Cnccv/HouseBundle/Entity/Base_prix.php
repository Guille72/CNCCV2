<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
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
     * @var \DatePeriod
     *
     * @ORM\Column(name="date_debut", type="date", unique=true)
     */
    private $dateDebut;

    /**
     * @var \DatePeriod
     *
     * @ORM\Column(name="date_fin", type="date", unique=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;


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
     * Set dateDebut
     *
     * @param \DatePeriod $dateDebut
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
     * @return \DatePeriod
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DatePeriod $dateFin
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
     * @return \DatePeriod
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set prix
     *
     * @param integer $prix
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
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Base_prix
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
}
