<?php

namespace Cnccv\HouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="Cnccv\HouseBundle\Repository\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="comm", type="string", length=255)
     */
    private $comm;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Cnccv\HouseBundle\Entity\Booking")
     * @ORM\JoinColumn(name="booking_id", referencedColumnName="id")
     */
    protected $booking_id;

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
     * @var int
     *
     * @ORM\Column(name="global", type="integer", nullable=true)
     */
    private $global;

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
     * @return Note
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
     * @return Note
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
     * @return Note
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
     * @return Note
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
     * @return Note
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
     * Set global
     *
     * @param string $global
     *
     * @return Note
     */
    public function setGlobal($global)
    {
        $this->global = $global;

        return $this;
    }

    /**
     * Get global
     *
     * @return string
     */
    public function getGlobal()
    {
        return $this->global;
    }

    /**
     * Set userId
     *
     * @param \Cnccv\HouseBundle\Entity\User $userId
     *
     * @return Note
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
     * Set bookingId
     *
     * @param \Cnccv\HouseBundle\Entity\Booking $bookingId
     *
     * @return Note
     */
    public function setBookingId(\Cnccv\HouseBundle\Entity\Booking $bookingId = null)
    {
        $this->booking_id = $bookingId;

        return $this;
    }

    /**
     * Get bookingId
     *
     * @return \Cnccv\HouseBundle\Entity\Booking
     */
    public function getBookingId()
    {
        return $this->booking_id;
    }
}
