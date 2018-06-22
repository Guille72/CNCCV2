<?php

namespace App;


/**A AMELIORER : injection de dépendance = entrer la connexion à la base dans le constructeur.
 * Class Sejour
 * @package App
 */
class Sejour {

    /**
     * @var array
     */
    private $db;
    /**
     * @var array
     */
    private $data; //est l'array contenant Arrivée, Départ, Nombre de personnes et Logement voire Id client
    /**
     * @var string
     */
    public $paragraphe = 'div';

    private $parametres;

    /**
     * Logements constructor.
     * @param array $data
     */
    public function __construct(\Core\Database\MysqlDatabase $db, $data=array()){

        $this->db = $db;
        $this->data = $data;
    }

    /**
     * A REVOIR : fonction Pour le CSS autour du Formualaire :
     * Fonction possiblement désuète à la fin du développement du site...
     * Fonctionne avec Paragraphe qu'il faut renseigner préalablement :
     * par défaut génère des balises span si (public $paragraphe = 'span');,
     * mais on doit pouvoir y mettre ce que l'on veut
     * @param $html
     * @return string
     */
    private function surround($html){
        return "<{$this->paragraphe}>{$html}</{$this->paragraphe}>";
    }

    /**
     * Permet de conserver le champs renseigné dans l'input
     * @param $index
     * @return mixed|null
     */
    private function getValue($index){
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
    private function input($type, $name, $label) {
        return $this->surround('
        <label>'.$label.'</label>
        <input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" required >');
    }

    /**
     * Génère un submit en html : cf. input ci-dessus
     * @return string
     */
    private function submit() {
        return $this->surround('<button type="submit">Poursuivre ma Réservation</button>');
    }

    /**
     *
     * Génère le formulaire
     * @return string
     */
    public function formulaireSejour(){

        $content='<div class="Formulaire" >
                    <Form method="post" action="">';
        $content.= $this->input('date','arrivee', 'Arrivée');
        $content.= $this->input('date','depart', 'Départ');
        $content.= $this->input('number','NombrePersonne', 'Nombre de personnes');
        $content.= $this->submit();
        $content.=' </form>
                    </div>';

        return $content;
    }

    /**
     * teste la disponibilité d'un séjour sur la $maison sélectionnée
     * @param string $maison
     * @return boolean
     *
     */

    public function disponibilite($maison){

        $rep = $this->db->prepareSMEF('SELECT * FROM bookings WHERE bookings.annulation IS NULL AND ? BETWEEN bookings.arrivee AND date_sub(bookings.depart, interval 1 day) AND bookings.nomMaison = ?', array($this->data['arrivee'], $maison));
        $rep2 = $this->db->prepareSMEF('SELECT * FROM bookings WHERE bookings.annulation IS NULL AND ? BETWEEN date_add(bookings.arrivee,interval 1 day) AND bookings.depart AND bookings.nomMaison = ?', array($this->data['depart'], $maison));
        $rep3 = $this->db->prepareSMEF('SELECT * FROM bookings WHERE bookings.annulation IS NULL AND date_add(?,interval 1 day) < bookings.arrivee AND date_sub(?,interval 1 day) > bookings.depart AND bookings.nomMaison=?', array($this->data['arrivee'], $this->data['depart'], $maison));

        if ($rep===false && $rep2===false && $rep3===false)
        {
            $dispo= true;
        }
        else
        {
            $dispo= false;
        }

        return $dispo;
    }

    /**
     *A AMELIORER
     *Permet de charger l'ensemble des paramêtres tarifaires disposés ensuite dans un array
     * les paramêtres chargés sont ceux de la table "parametres"...
     * A AMELIORER : on doit pouvoir rendre la fonction static avec une variable static attachée
     * qui éviterait de recharger tout depuis la bdd...
     *
     * @return array
     */
    private function chargementParametre()
    {
        if (is_null($this->parametres)) {
            $this->parametres = $this->db->querySMEF('SELECT * FROM parametres WHERE id=1');
            var_dump('parametres appelés');
        }
        var_dump('parametres utilisés');
        return $this->parametres;
    }

    /**
     *
     * Retourne le prix d'un séjour dans une maison donnée : s'aide en cela de toutes les fonctions listées en private ci-dessous
     * NombreMenageSejour() : retourne le nombre de ménage "imposés/à facturer" lors d'un séjour
     * PrixBaseSejour() : additionne les prix de base de chaque journée
     * PrixBaseJour() : retourne le prix de Base d'un jour en particlier en checkant dans la table "events" pour savoir si le tarif doit être ajusté.
     * NombreNuit() : retourne le nombre de nuit entre les dates d'arrivée et de départ
     *
     * @param $maison
     * @return array
     */
    public function PrixDuSejour($maison){

            $parametres=$this->chargementParametre();

            $coef = $this->db->prepareSMEF('SELECT coefPrixMaison FROM coefprixlogement WHERE nomMaison= ?',[$maison]);

            $coefNombrePersonne = ($this->data['NombrePersonne'] > 2) ? 1+($parametres['coefPersSupp']*($this->data['NombrePersonne']-2)) : 1 ;

            $PrixBaseHT = $this->PrixBaseSeJour()*floatval($coef['coefPrixMaison'])*$coefNombrePersonne;

            $PrixMenageHT= $this->NombreMenageSejour()*floatval($parametres['forfaitMenage']);
            $TvaMenage= $PrixMenageHT*$parametres['tva'];

            $TaxeSejour = $this->NombreNuit()*$this->data['NombrePersonne']*$parametres['taxeSejour'];

            $PrixBaseClient =  ceil(($PrixBaseHT +  $PrixMenageHT)*(1+$parametres['tva']) + $TaxeSejour);

            $PrixSejourHT= ($PrixBaseClient-$TaxeSejour)/(1+$parametres['tva'])-$PrixMenageHT;
            $TvaSejour= $PrixSejourHT*$parametres['tva'];



            $PrixSejour = array( "PrixSejourTotalTTC"=> $PrixBaseClient,
                                 "TaxeSejour"=> $TaxeSejour,
                                 "PrixSejourHT"=> $PrixSejourHT,
                                 "TvaSejour"=> $TvaSejour,
                                 "NombreMenage"=> $this->NombreMenageSejour(),
                                 "PrixMenageHT"=> $PrixMenageHT,
                                 "TvaMenage"=> $TvaMenage
                               );

        return $PrixSejour;
    }


    /**
     * cf. fonction PrixDuSejour()
     * @return int
     */
    private function NombreMenageSejour(){

            $parametres=$this->chargementParametre();

            $NombreMenageSejour = floor($this->NombreNuit()/$parametres['jourMenage']);

            $NombreMenageSejour = ($this->NombreNuit()-($NombreMenageSejour*$parametres['jourMenage'])<=2) ? $NombreMenageSejour : $NombreMenageSejour+1;

        return $NombreMenageSejour;
    }

    /**cf. fonction PrixDuSejour()
     * @return int
     */
    public function PrixBaseSejour()
    {
        $prixSejour = 0;
        $Jour = new \DateTime($this->data['arrivee']);
        $i = 1;

        while ($i <= $this->NombreNuit()) {
            $date= $Jour->format('Y-m-d');
            $prixJour = $this->PrixBaseJour($date);
            $prixSejour += $prixJour;
            $Jour->add(new \DateInterval('P1D')); // ajoute 1 jour
            $i++;
        }
        return $prixSejour;
    }
    /**cf. fonction PrixDuSejour()
     * @param $Date
     * @return int
     */
    private function PrixBaseJour($Date){

        $parametres= $this->chargementParametre();
        $Prix = $this->db->prepareSMEF('SELECT prix FROM events WHERE ? BETWEEN dateDebut AND dateFin',[$Date]);
        $PrixBaseJour = ($Prix === false)? $parametres['prixBase']: $Prix['prix'];
        return $PrixBaseJour;
    }

    /**cf. fonction PrixDuSejour()
     * Ci-dessous petit mémo notamment sur les variables à
     * utiliser fonction que l'on cherche à retourner un nombre de jour, ou d'heure, ou de minutes etc...
     * Powerful Function to get two date difference.
    //////////////////////////////////////////////////////////////////////
    //PARA: Date Should In YYYY-MM-DD Format
    //RESULT FORMAT:
    // '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
    // '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
    // '%m Month %d Day'                                            =>  3 Month 14 Day
    // '%d Day %h Hours'                                            =>  14 Day 11 Hours
    // '%d Day'                                                        =>  14 Days
    // '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
    // '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
    // '%h Hours                                                    =>  11 Hours
    // '%a Days                                                        =>  468 Days
    //////////////////////////////////////////////////////////////////////

     * @return int
     */
    private function NombreNuit()
    {
            $datetime1 = date_create($this->data['arrivee']);
            $datetime2 = date_create($this->data['depart']);

            $NombreNuit = date_diff($datetime1, $datetime2);

        return $NombreNuit->format('%a');

    }

    /**
     * @param $DateArrivee
     * @param $DateDepart
     * @param $NombrePersonne
     * @param $Logement
     */
    public function Reserver($DateArrivee, $DateDepart, $NombrePersonne, $Logement){



    }


    /**
     * @param $DateArrivee
     * @param $DateDepart
     * @param $NombrePersonne
     * @param $Logement
     */
    public function Annuler($DateArrivee, $DateDepart, $NombrePersonne, $Logement){


    }


    /**
     * @param $DateArrivee
     * @param $DateDepart
     * @param $NombrePersonne
     * @param $Logement
     */
    public function Modifier($DateArrivee, $DateDepart, $NombrePersonne, $Logement){


    }

}