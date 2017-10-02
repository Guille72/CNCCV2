<?php
    include("parametre_general_tarif.php");
require_once("icalendar-master/zapcallib.php");

    for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
    {
      include('bdd_connect.php');
      include("logements_presentation.php");
      $table='reservation_'.$lieu;
      $icalfeed = curl_get_contents($icalfile);

      // create the ical object
      $icalobj = new ZCiCal($icalfeed);

      // echo "Number of events found: " . $icalobj->countEvents() . "\n";

      $ecount = 0;

      // read back icalendar data that was just parsed
      if(isset($icalobj->tree->child))
      {
        foreach($icalobj->tree->child as $node)
        {
          if($node->getName() == "VEVENT")
          {
            $ecount++;
            // echo "Event $ecount:\n";
            foreach($node->data as $key => $value)
            {
              if($key == "SUMMARY" )
              {
              $nom_prenom= $value->getValues();

              }
              if($key == "DTSTART" )
              {
              $date_arrivee_airbnb= $value->getValues();
              $date_arrivee_airbnb = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_arrivee_airbnb);

              }
              if($key == "DTEND" )
              {
              $date_depart_airbnb= $value->getValues();
              $date_depart_airbnb = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_depart_airbnb);

              }
              if($key == "DESCRIPTION" )
              {
              $commentaire_arrivee= $value->getValues();

              }
            }
            
                $rep = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND date_arrivee=? AND date_depart=?');
                $rep->execute(array($date_arrivee_airbnb,$date_depart_airbnb));
                $already_in=$rep->fetch();

                $today=strtotime(date('Y-m-d'));
                $date_a_synchro=strtotime($date_arrivee_airbnb);


            if (!isset($already_in['num_reservation'])&& $nom_prenom!='Not available' && $date_a_synchro>=$today)
            {
              $req = $bdd->prepare('INSERT INTO '.$table.'(date_arrivee, date_depart, nom, commentaire_arrivee, date_reservation) VALUES(?, ?, ?, ?, Current_date)');
              $req->execute(array($date_arrivee_airbnb, $date_depart_airbnb, $nom_prenom, $commentaire_arrivee));
              $req->closeCursor();
            }
            $rep->closeCursor();

          }
        }
      }
    }





    
?>