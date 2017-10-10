<?php

namespace MC\ProduitsEnSartheBundle\Flash;

class TitledFlashMessage
{
    protected $title;

    public function __construct($title, $message, $type=null) {
        parent::__construct($message, $type);
        $this->setTitle($title);
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
}