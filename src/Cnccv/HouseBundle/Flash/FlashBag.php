<?php

namespace MC\ProduitsEnSartheBundle\Flash;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;


class FlashBag implements FlashBagInterface
{
    protected $name;
    protected $messages	= array();

    public function __construct($name) {
        $this->setName($name);
    }

    /**
     * Set name of the bag
     *
     * @param string $name
     */
    public function setName($name) {
        $this->name	= $name;
    }

    /**
     * Get name of the bag
     *
     * @return	string $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add a flash message with $type.
     *
     * @param string $type
     * @param string $message
     * @param null   $title
     * @see		\Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::add()
     */
    public function add($type, $message, $title=null) {
        if( !$this->has($type) ) {
            $this->messages[$type]	= array();
        }
        /* @var $message FlashMessage */
        $message	= FlashMessage::create($type, $message, $title);
        $message->setType($type);// Object integrity
        $this->messages[$type][]	= $message;
    }

    /**
     * Add a flash message
     *
     * @param	FlashMessage $message
     * @see		FlashBag::add()
     */
    public function put(FlashMessage $message) {
        $this->add($message->getType(), $message);
    }

    /**
     * Add an error flash message.
     *
     * @see		FlashBag::add()
     */
    public function addError($message, $title=null) {
        $this->add(FlashMessage::TYPE_ERROR, $message, $title);
    }

    /**
     * Add a success flash message.
     * @see FlashBag::add()
     */
    public function addSuccess($message, $title=null) {
        $this->add(FlashMessage::TYPE_SUCCESS, $message, $title);
    }

    /**
     * Add a warning flash message.
     * @see FlashBag::add()
     */
    public function addWarning($message, $title=null) {
        $this->add(FlashMessage::TYPE_WARNING, $message, $title);
    }

    /**
     * Add an info flash message.
     * @see FlashBag::add()
     */
    public function addInfo($message, $title=null) {
        $this->add(FlashMessage::TYPE_INFO, $message, $title);
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::set()
     */
    public function set($type, $messages) {
        $this->messages[$type]	= $messages;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::peek()
     */
    public function peek($type, array $default = array()) {
        return $this->has($type) ? $this->messages[$type] : $default;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::peekAll()
     */
    public function peekAll() {
        $r	= array();
        foreach( $this->messages as $type => $typeMessages ) {
            foreach( $typeMessages as $message ) {
                $r[]	= $message;
            }
        }
        return $r;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::get()
     */
    public function get($type, array $default = array()) {
        $r	= $this->peek($type, $default);
        unset($this->messages[$type]);
        return $r;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::all()
     */
    public function all() {
        $r	= $this->peekAll();
        $this->clear();
        return $r;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::setAll()
     */
    public function clear($type=null) {
        if( $type ) {
            unset($this->messages[$type]);
        } else {
            $this->messages	= array();
        }
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::setAll()
     */
    public function setAll(array $messages) {
        $this->clear();
        foreach( $messages as $message ) {
            /* @var $message FlashMessage */
            $this->set($message->getType(), $message->getMessage());
        }
    }

    public function initialize(array &$messages) {
        $this->messages	= $messages;
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::has()
     */
    public function has($type) {
        return isset($this->messages[$type]);
    }

    /* (non-PHPdoc)
     * @see \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface::keys()
     */
    public function keys() {
        return array_keys($this->messages);
    }

    public function getStorageKey() {
        return '_am_flashes';
    }

}