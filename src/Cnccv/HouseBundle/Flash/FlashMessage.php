<?php

namespace MC\ProduitsEnSartheBundle\Flash;

class FlashMessage
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $message;

    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_INFO = 'info';

    /**
     * Constructor.
     * @param      $message
     * @param null $type
     */
    public function __construct($message, $type=null) {
        $this->setType($type);
        $this->setMessage($message);
    }

    /**
     * Get the type.
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set the type.
     * @param string $type
     * @return \MC\ProduitsEnSartheBundle\Flash\FlashMessage
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the message.
     * @return mixed
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Set the message.
     * @param $message
     * @return $this
     */
    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    /**
     * Create a FlashMessage.
     * If getting a FlashMessage, this function just returns it.
     * If we got a string, we create a new FlashMessage.
     * @param string $type
     * @param mixed|FlashMessage $message
     * @param null $title
     * @throws \Exception
     * @return TitledFlashMessage|FlashMessage
     */
    public static function create($type, $message, $title=null) {
        if( $message instanceof FlashMessage ) {
            return $message;
        }
        return $title ? new TitledFlashMessage($title, $message, $type) : new FlashMessage($message, $type);
    }
}