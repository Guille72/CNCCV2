<?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 15/06/2018
 * Time: 11:05
 */
namespace App;

use Core\Config;
use Core\Database;

/**
 * Class App
 * @package App
 */
class App
{
    /**
     *
     */
    const TITLE = "CNcCV";
    /**
     * @var string
     */
    private static $title = '';

    /**
     * @var
     */
    private $db_instance;
    /**
     * @var
     */
    private static $_instance;
    /*
         *
         *
         * Ci-dessous un "factory" à utiliser si intérêt d'organiser le site autour de la Classe App
         *

        Public static function load(){
            session_start();
            require_once ROOT.'/app/Autoloader.php';
            App\Autoloader::register();
            require_once ROOT.'/core/Autoloader.php';
            Core\Autoloader::register();
        }
    */


    /**
     * @return App
     */
    public static function getInstance(){
                if(is_null(self::$_instance)){
                    self::$_instance=new App();
                }
                return self::$_instance;
            }

    /**
     * @param $data
     * @return Sejour
     */
    public function getSejour($data){

            return new Sejour($this->getDb(),$data);

        }

    /**
     * @param $data
     * @return Sejour
     */
     public function getCalendrier($data){

       return new Calendrier($this->getDb(),$data);

     }

    /**
     * @param $maison
     * @return array
     */
    public function getParametreLogement($maison){

            return \App\Logements\Logements::getParametreLogement($this->getDb(),$maison);

        }

    /**
     * @return Database\MysqlDatabase
     */
    public function getDb(){
            $config = Config::getInstance(ROOT.'/config/config.php');
            if(is_null($this->db_instance)){
                $this->db_instance=new Database\MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
            }
            return $this->db_instance;
        }

    /**
     *
     */
    public static function forbidden()
    {
        header("HTTP/1.0 403 Forbidden");
        die('Accès interdit');
        header('location:index.php?p=403');
    }


    public static function notFound()
        {
            header("HTTP/1.0 404 Not Found");
            die('Page non trouvée');
            header('location:index.php?p=404');
        }

    /**
     * @return string
     */
    public static function getTitle()
        {
            return self::$title;
        }

    /**
     * @param $title
     */
    public static function setTitle($title){
            ($title!='')? $title=' | '.$title:$title;
            self::$title= self::TITLE.$title;
        }


}