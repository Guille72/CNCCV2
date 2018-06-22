<?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 10/06/2018
 * Time: 15:54
 */

namespace App\Logements;

use App\App;

class Logements
{

    public static function getParametreLogement(\Core\Database\MysqlDatabase $db, $maison){
        $contenu=$db->prepare('SELECT * FROM logements WHERE nomMaison=?', [$maison],__CLASS__,true);
        $NombreChambre=$contenu->nombreChambre;
        $Surface=$contenu->surface;
        $Adresse=$contenu->adresse.', '.$contenu->codePostal.' '.$contenu->ville;
        $Description=$contenu->description;
        $Googlemap=$contenu->googlemap;

        $Parametres=array("NombreChambre"=>$NombreChambre,
                          "Surface"=>$Surface,
                          "Adresse"=>$Adresse,
                          "Description"=>$Description,
                          "Googlemap"=>$Googlemap,
                         );

        return $Parametres;
    }

    public static function getCarrousel($maison) {
        $i=1;
        $carrousel='';
        $path = 'img/'.$maison.'/'.$maison;
        while (file_exists($path.$i.'.JPG'))
        {
            $image= $path.$i.'.JPG';
            $carrousel.='<a class="carousel-item" href="#'.$i.'"><img class="responsive-img materialboxed" src="'.$image.'"></a>';
            $i++;
        }
        return $carrousel;
    }
/*
    public function __get($key){
        $method = 'get'.ucfirst($key);
        $this->$key= $this->$method();
        return $this->$key;
    }

    public function getUrl(){
        return 'index.php?p=article&id='.$this->id;
    }

    public function getExtrait(){
        $html = '<p>'.substr($this->contenu,0,100).'...</p>';
        $html.= '<p><a href="'.$this->getUrl().'">Voir la suite</a></p>';

        return $html;
    }
*/
}