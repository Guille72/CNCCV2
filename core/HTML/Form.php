<?php
namespace Core\HTML;
/**
 * Class Form
 */
Class Form {

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

    /**
     * @param $html
     * @return string
     */
    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $index
     * @return mixed|null
     */
    protected function getValue($index){
        return isset($this->data{$index})? $this->data[$index]: null;
    }


    /**
     * @param $name
     * @return string
     */
    public function input($name) {
       return $this->surround('<input type="text" name="'.$name.'" value="'.$this->getValue($name).'">');

    }

    /**
     * @return string
     */
    public function submit() {
        return $this->surround('<button type="submit">Envoyer</button>');

    }



}