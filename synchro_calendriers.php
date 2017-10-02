<?php

/**
 * Parse iCalendar Example
 *
 * Enter an ics filename or URL on the command line, 
 * or leave blank to parse the default file.
 *
 */

require_once("icalendar-master/zapcallib.php");


$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
$icalfeed = curl_get_contents($icalfile);

// create the ical object
$icalobj = new ZCiCal($icalfeed);

// echo "Number of events found: " . $icalobj->countEvents() . "\n";

$ecount = 0;


include('bdd_connect.php');

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
				$date_arrivee= $value->getValues();
				$date_arrivee = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_arrivee);

				}
				if($key == "DTEND" )
				{
				$date_depart= $value->getValues();
				$date_depart = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_depart);

				}
				if($key == "DESCRIPTION" )
				{
				$commentaire_arrivee= $value->getValues();

				}
			}
			
        	$rep = $bdd->prepare('SELECT * FROM reservation_rousseau WHERE annule_le IS NULL AND date_arrivee=? AND date_depart=?');
	        $rep->execute(array($date_arrivee,$date_depart));
	        $already_in=$rep->fetch();

	        $today=strtotime(date('Y-m-d'));
	        $date_a_synchro=strtotime($date_arrivee);


			if (!isset($already_in['num_reservation'])&& $nom_prenom!='Not available' && $date_a_synchro>=$today)
			{
				$req = $bdd->prepare('INSERT INTO reservation_rousseau(date_arrivee, date_depart, nom, commentaire_arrivee, date_reservation) VALUES(?, ?, ?, ?, Current_date)');
			    $req->execute(array($date_arrivee, $date_depart, $nom_prenom, $commentaire_arrivee));

			}

		}
	}

include("parametre_general_tarif.php");

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


}



function curl_get_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}