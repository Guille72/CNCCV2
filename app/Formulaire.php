<?php
namespace App;

/**
 * app Form
 * @package app
 */
Class Formulaire {

    /**
     * @var array
     */
    protected $data;
    /**
     * @var string
     */
    public $surround ='p';

    /**
     * Form constructor.
     * @param array $data
     */
    public function __construct($data=array()){
        $this->data =$data;
    }


    public function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * Permet de conserver le champs renseigné dans l'input
     * @param $index
     * @return mixed|null
     */
    public function getValue($index){
        return isset($this->data{$index})? $this->data[$index]: null;
    }

    /**
     * Génère un input en html : permet notamment de réaliser le formulaire
     * du CSS peut être injecté via la variable $Paragraphe qu'il faut paramêtrer (cf. function surround)
     * @param $type
     * @param $name
     * @param $label
     * @return string
     */
    public function input($type, $name, $class='', $id='', $options='') {
        return $this->surround('<input type="' . $type . '" name="' . $name . '" class="' . $class . '" id="' . $id . '" value="' . $this->getValue($name) . '" '.$options.' required >');
    }

    /**
     * Génère un submit en html : cf. input ci-dessus
     * @return string
     */
    public function submit($name, $class, $text) {
        return $this->surround('<button type="submit" name="' . $name . '" class="' . $class . '">' . $text . '</button>');
    }

}