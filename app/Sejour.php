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


    /**
     *
     * Génère le formulaire
     * @return string

    public function formulaireSejour(){

          $content='<Form method="post" action="">
                      <div id="resaForm" >
                            <!-- Titre -->
                        <div id="titleForm">
                          <h5>Reservez dès maintenant</h5>
                        </div>

          <!-- Selection du nb de personnes -->
                    <div id="nbPersonne">
                      <p class="range-field">'.
                        $this->input('range','NombrePersonne', 'Nombre de personnes').'
                      </p>
                    </div>

          <!-- Choix de la date -->
                    <div id="dataPickerForm" class="row">

                      <div class="col s6">
                      '.$this->input('date','arrivee', 'Arrivée').'
                    </div>

                      <div class="col s6">
                      '.$this->input('date','depart', 'Départ').'
                    </div>

                    </div>


              <!-- Button submit -->
                    <div id="submitResaForm" class="row">

                      <div class="col s12">
                      <button class="btn waves-effect waves-light bgBlueForm" type="submit" name="action">Poursuivre ma réservation
                        <i class="material-icons right">send</i>
                      </button>
                      </div>

                    </div>

                  </div>
                </form>';

        return $content;
    }
     */
    /**
     * teste la disponibilité d'un séjour sur la $maison sélectionnée
     * @param string $maison
     * @return boolean
     *
     */


    public function disponibilite($maison){

        $this->data['arrivee']= date('Y-m-d',strtotime($this->data['arrivee']));
        $this->data['depart']= date('Y-m-d',strtotime($this->data['depart']));

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
     *Renvoie par maison sous forme d'array : soit que le bien
     * - est disponible MAIS nombre de personnes souhaité trop grand : renvoie "limité à x personnes"
     * - est disponible Et donc donne le prix : renvoie " x euros".
     * - n'est pas disponible : renvoie "Pas Dispo"
     * @return $result array
     */

    public function dispoPrix(){
        //$maisons=$this->db->queryAllSMEF('SELECT nomMaison FROM logements');

        //var_dump($maisons);
       require ROOT.'/settings/maisons.php';
        // var_dump($maisons);
       // var_dump($maisons[1]);
       // var_dump($maisons[2]);

        $_SESSION['arrivee']= $this->data['arrivee'];
        $_SESSION['depart']= $this->data['depart'];
        $_SESSION['NombrePersonne']=$this->data['NombrePersonne'];

        foreach ($maisons as $maison) {
            //var_dump($maison);
            $persMax=$this->db->prepareSMEF('SELECT persMax FROM logements WHERE nomMaison= ?',[$maison]);
            $_SESSION['dispo'.$maison]=$this->disponibilite($maison);
            if ($_SESSION['dispo'.$maison]=== true && $this->data['NombrePersonne'] > $persMax['persMax']){
                $_SESSION[$maison] = 'Limité à '.$persMax['persMax'].' personnes';
            }elseif ($_SESSION['dispo'.$maison]=== true && $this->data['NombrePersonne'] <= $persMax['persMax']) {
                $prix=$this->PrixDuSejour($maison);
                $_SESSION[$maison]=$prix['PrixSejourTotalTTC'].' euros';
                $_SESSION[$maison.'PrixSejourTotalTTC']=$prix['PrixSejourTotalTTC'];
                $_SESSION[$maison.'TaxeSejour']=$prix['TaxeSejour'];
                $_SESSION[$maison.'PrixSejourHT']=$prix['PrixSejourHT'];
                $_SESSION[$maison.'TvaSejour']=$prix['TvaSejour'];
                $_SESSION[$maison.'NombreMenage']=$prix['NombreMenage'];
                $_SESSION[$maison.'PrixMenageHT']=$prix['PrixMenageHT'];
                $_SESSION[$maison.'TvaMenage']=$prix['TvaMenage'];

            }else {
                $_SESSION[$maison]='Pas dispo';
            }
        }
        return;
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
        }
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

                $parametres = $this->chargementParametre();

                $coef = $this->db->prepareSMEF('SELECT coefPrixMaison FROM coefprixlogement WHERE nomMaison= ?', [$maison]);

                $coefNombrePersonne = ($this->data['NombrePersonne'] > 2) ? 1 + ($parametres['coefPersSupp'] * ($this->data['NombrePersonne'] - 2)) : 1;

                $PrixBaseHT = $this->PrixBaseSeJour() * floatval($coef['coefPrixMaison']) * $coefNombrePersonne;

                $PrixMenageHT = round($this->NombreMenageSejour() * floatval($parametres['forfaitMenage']),2);
                $TvaMenage = round($PrixMenageHT * $parametres['tva'],2);

                $TaxeSejour = $this->NombreNuit() * $this->data['NombrePersonne'] * $parametres['taxeSejour'];

                $PrixBaseClient = ceil(($PrixBaseHT + $PrixMenageHT) * (1 + $parametres['tva']) + $TaxeSejour);

                $PrixSejourHT = round(($PrixBaseClient - $TaxeSejour) / (1 + $parametres['tva']) - $PrixMenageHT,2);
                $TvaSejour = round($PrixSejourHT * $parametres['tva'],2);

                $PrixSejour = array("PrixSejourTotalTTC" => $PrixBaseClient,
                                    "TaxeSejour" => $TaxeSejour,
                                    "PrixSejourHT" => $PrixSejourHT,
                                    "TvaSejour" => $TvaSejour,
                                    "NombreMenage" => $this->NombreMenageSejour(),
                                    "PrixMenageHT" => $PrixMenageHT,
                                    "TvaMenage" => $TvaMenage
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