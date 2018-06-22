<?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 07/06/2018
 * Time: 23:15
 */

namespace Core;

/**
 * Class Config
 * @package App
 */
class Config
{

    /**
     * @var array|mixed
     */
    private $settings=[];
    /**
     * @var
     */
    private static $_instance;

    /**Ceci est un SINGLETON : permet de n'instancier qu'une seule fois la classe
     * @param $file
     * @return Config
     */
    Public static function getInstance($file){
        If (is_null(self::$_instance)){
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }

    /**
     * Config constructor.
     * @param $file
     */
    Public function __construct($file)
    {
        $this->settings = require($file);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    Public function get($key){

        if (!isset($this->settings[$key])){
            return null;
        }

        return $this->settings[$key];

    }

}