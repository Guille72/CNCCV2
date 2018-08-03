<?php
/**
 * Created by PhpStorm.
 * User: guill_n3dyp4y
 * Date: 13/07/2018
 * Time: 16:46
 */

namespace App;


class Calendrier
{

    /**
     * @var array
     */
    private $db;

    Private $data;


    public function __construct(\Core\Database\MysqlDatabase $db, $data= array())
    {
        $this->db = $db;
        $this->data = $data;

    }


    public function afficherCalendrier($maison) {

        if ($this->data['arrivee']!=null) {
            $moisCourant= date("m",strtotime($this->data['arrivee']));
            $anneeCourante=date("Y",strtotime($this->data['arrivee']));
        } else {
            $moisCourant = date("m");
            $anneeCourante = date("Y");
        }

        $pas=0;

        $content="";

        //ici peut être défini le nombre de mois que l'on affiche "while ($pas<x) où x représente le nombre de mois affichés
        while ($pas<3)
        {
            $periode=$anneeCourante."-".$moisCourant;

            $content.="<div style=\"font-size:12px;border:1px solid;margin:5px;\">".$this->buildCalendar($periode,$maison)."</div>";

            $moisCourant++;
            if ($moisCourant==13){$moisCourant=1;$anneeCourante++;}
            $pas++;
        }

        return $content;

    }



    private function buildCalendar($periode, $maison) {
        $leCalendrier = "";
        // Tableau des valeurs possibles pour un numéro de jour dans la semaine
        $tableau = Array("0", "1", "2", "3", "4", "5", "6", "0");

        $nb_jour = Date("t", mktime(0, 0, 0, $this->getMonth($periode), 1, $this->getYear($periode)));
        $pas = 0;
        $indexe = 1;

        // Affichage du mois et de l'année
        $leCalendrier .= "\n\t<div style=\"text-align:center;color:#FF0048;font-size:15px;font-weight:bold;\">" . $this->monthNumToName($this->getMonth($periode)) . " " . $this->getYear($periode) . "</div>";

        // Affichage des entêtes
        $leCalendrier .= "
            <ul class=\"libelle\">
                \t<li>L</li>
                \t<li>M</li>
                \t<li>M</li>
                \t<li>J</li>
                \t<li>V</li>
                \t<li>S</li>
                \t<li>D</li>
            </ul>";
        // Tant que l'on n'a pas affecté tous les jours du mois  traité
        while ($pas < $nb_jour) {
            if ($indexe == 1) $leCalendrier .=
                "\n\t<ul class=\"ligne\">";

            // Si le jour calendrier == jour de la semaine en cours
            if (Date("w", mktime(0, 0, 0, $this->getMonth($periode),
                    1 + $pas, $this->getYear($periode))) == $tableau[$indexe]) {
                // Si jour calendrier == aujourd'hui
                $afficheJour = Date("j", mktime(0, 0, 0,
                    $this->getMonth($periode), 1 + $pas, $this->getYear($periode)));
                    $jour = Date("Y-m-d",mktime(0, 0, 0, $this->getMonth($periode), 1 + $pas, $this->getYear($periode))) ;
                    $num_id=strtotime($jour)/86400;
                if (Date("Y-m-d", mktime(0, 0, 0, $this->getMonth($periode),
                        1 + $pas, $this->getYear($periode))) <= Date("Y-m-d")) {
                    $class = " class=\"itemPastItem $num_id\" id=\"".$jour."\"   onclick=\" \""; if (Date("Y-m-d", mktime(0, 0, 0, $this->getMonth($periode),
                            1 + $pas, $this->getYear($periode))) == Date("Y-m-d")) {
                        $class = " class=\"itemCurrentItem $num_id\" id=\"".$jour."\" onmouseover=\"showDay(this,dayList)\"   onclick=\"selectDay(this,dayList)\""; }}


                else {
                    $rep = $this->db->prepareSMEF('SELECT * FROM bookings WHERE bookings.annulation IS NULL AND ? BETWEEN arrivee AND date_sub(depart, interval 1 day) AND nomMaison = ?',[$jour, $maison]);

                    // 1 est toujours vrai => on affiche un lien à chaque fois
                    // A vous de faire les tests nécessaire si vous gérer un agenda par exemple
                    if ($rep!=false) {
                        $class = " class=\"itemExistingItem $num_id\" id=\"".$jour."\"   onclick=\" \"";
                        $afficheJour=Date("j",
                            mktime(0, 0, 0, $this->getMonth($periode), 1 +
                                $pas, $this->getYear($periode)));

                    }
                    else {
                        //$jour =strtotime($jour);
                        $class = " class=\"itemPickableItem $num_id\" id=\"".$jour."\" onmouseover=\"showDay(this,dayList)\"   onclick=\"selectDay(this,dayList)\"";
                        $afficheJour=Date("j",
                            mktime(0, 0, 0, $this->getMonth($periode), 1 +
                                $pas, $this->getYear($periode)));

                    }
                }
                // Ajout de la case avec la date
                $leCalendrier .= "\n\t\t<li $class>
                     $afficheJour</li>";
                $pas++;
            }
            //
            else {

                // Ajout d'une case vide
                $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
            }
            if ($indexe == 7 && $pas < $nb_jour)
            { $leCalendrier
                .= "\n\t</ul>"; $indexe = 1;} else {$indexe++;}
        }

        // Ajustement du tableau
        for ($i = $indexe; $i <= 7; $i++) {
            $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
        }
        $leCalendrier .= "\n\t</ul>\n";


       // var_dump($leCalendrier);
        // Retour de la chaine contenant le Calendrier
        return $leCalendrier;
    }


// fonctions utiles, $valeur représente une date au format AAAA-MM-JJ


    private function getMonth($valeur)     {
        return substr($valeur, 5, 2);
    }

    private function getYear($valeur) {
        return substr($valeur, 0, 4);
    }

    private function monthNumToName($mois) {
        $tableau = Array("", "Janvier", "Février",
            "Mars", "Avril", "Mai", "Juin", "Juillet",
            "Août", "Septembre", "Octobre", "Novembre", "Décembre");

        return (intval($mois) > 0 && intval($mois) < 13) ? $tableau[intval($mois)] : "Indéfini";
    }


}
