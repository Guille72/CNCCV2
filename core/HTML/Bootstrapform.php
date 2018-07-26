<?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 12/06/2018
 * Time: 19:38
 */

namespace Core\HTML;

class Bootstrapform extends Form
{

    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

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