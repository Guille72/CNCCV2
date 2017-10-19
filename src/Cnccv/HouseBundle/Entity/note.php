<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\noteRepository")
 */
class note
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
     * @ORM\ManyToOne(targetEntity="CnccvHouseBundle\Entity\logement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $logement;

    /**
     * @var string
     *
     * @ORM\Column(name="comm", type="string", length=255)
     */
    private $comm;

    /**
     * @var int
     *
     * @ORM\Column(name="proprete", type="integer")
     */
    private $proprete;

    /**
     * @var int
     *
     * @ORM\Column(name="accueil", type="integer")
     */
    private $accueil;

    /**
     * @var int
     *
     * @ORM\Column(name="confort", type="integer")
     */
    private $confort;

    /**
     * @var int
     *
     * @ORM\Column(name="etoile", type="integer", nullable=true)
     */
    private $etoile;


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
     * Set comm
     *
     * @param string $comm
     *
     * @return note
     */
    public function setComm($comm)
    {
        $this->comm = $comm;

        return $this;
    }

    /**
     * Get comm
     *
     * @return string
     */
    public function getComm()
    {
        return $this->comm;
    }

    /**
     * Set proprete
     *
     * @param integer $proprete
     *
     * @return note
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
     * @return note
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
     * @return note
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
     * Set etoile
     *
     * @param integer $etoile
     *
     * @return note
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
     * Set logement
     *
     * @param \CnccvHouseBundle\Entity\logement $logement
     *
     * @return note
     */
    public function setLogement(\CnccvHouseBundle\Entity\logement $logement)
    {
        $this->logement = $logement;

        return $this;
    }

    /**
     * Get logement
     *
     * @return \CnccvHouseBundle\Entity\logement
     */
    public function getLogement()
    {
        return $this->logement;
    }
}
