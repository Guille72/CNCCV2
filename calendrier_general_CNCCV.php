<?php

require_once("icalendar-master/zapcallib.php");

include("parametre_general_tarif.php");

include("bdd_connect.php");

$j=1;

for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
{
        include("logements_presentation.php");
        $table='reservation_'.$lieu;
        ${'icalobj'.$j} = new ZCiCal();
        $i=1;
		$calendrier= $bdd->query('SELECT * FROM '.$table.' WHERE date_arrivee >= current_date AND annule_le IS NULL');
        while($reservation=$calendrier->fetch())
            {
            	${'eventobj'.$i} = new ZCiCalNode("VEVENT", ${'icalobj'.$j}->curnode);
            	${'eventobj'.$i}->addNode(new ZCiCalDataNode("DTSTART:" . ZCiCal::fromSqlDateTime($reservation['date_arrivee'])));
				${'eventobj'.$i}->addNode(new ZCiCalDataNode("DTEND:" . ZCiCal::fromSqlDateTime($reservation['date_depart'])));
				${'eventobj'.$i}->addNode(new ZCiCalDataNode("UID:" . $reservation['email']));
				$date_arrivee= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$reservation['date_arrivee']);
				$date_depart= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$reservation['date_depart']);
				${'eventobj'.$i}->addNode(new ZCiCalDataNode("DESCRIPTION:" . ZCiCal::formatContent(
					"Arrivée : ".$date_arrivee."\nDépart : ".$date_depart."\nNombre de nuits: ".$reservation['nombre_nuit']."\nTéléphone : ".$reservation['telephone']."\nEmail : ".$reservation['email']."\nCommentaire : ".$reservation['commentaire_arrivee'])));
				${'eventobj'.$i}->addNode(new ZCiCalDataNode("SUMMARY:" . $reservation['prenom']." ".$reservation['nom']));
				$i++;
            }
          $fichier_calendrier = ${'icalobj'.$j}->export();  
          unlink('CALENDRIERS/calendier_'.$lieu.'.ics');        
          $monfichier = fopen('CALENDRIERS/calendier_'.$lieu.'.ics', 'a+');
          fputs($monfichier, $fichier_calendrier);
          fclose($monfichier);
          $j++;
 }

$calendrier->closeCursor();

?>