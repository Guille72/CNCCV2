<?php 

if ($logement==1) 
	{
		$lieu="rousseau";
		$lieuMAJ="ROUSSEAU";
		$adresse_logement="193, boulevard Jean-Jacques Rousseau 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=193+Boulevard+Jean+Jacques+Rousseau,+Le+Mans,+France";
		$adresse_logement_piece="\n193, boulevard Jean-Jacques Rousseau\n72100 LE MANS";
		$prix_base="50€TTC";
		$poele=false;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="35m²";
		$type_logement="Appartement";
		$nbre_chambre="1";
		$capacite="4 personnes";
		$max_nbre_personne=4;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1;
	}

else if ($logement==2) 
	{
		$lieu="champion";
		$lieuMAJ="CHAMPION";
		$adresse_logement="17, impasse Henri Champion 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=17+Rue+Henri+Champion,+72100+Le+Mans";
		$adresse_logement_piece="\n17, impasse Henri Champion\n72100 LE MANS";
		$prix_base="70€TTC";
		$poele=true;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="55m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.2;
	}

else if ($logement==3) 
	{
		$lieu="rousseau";
		$lieuMAJ="CANONS";
		$adresse_logement="6, rue des Canons 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=6+Rue+des+canons,+72100+Le+Mans";
		$adresse_logement_piece="6, rue des Canons\n72100 LE MANS";
		$prix_base="70€TTC";
		$poele=true;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="60m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.1;
	}

else if ($logement==4) 
	{
		$lieu="rousseau";
		$lieuMAJ="PAVOINE";
		$adresse_logement="9, rue Pierre Pavoine 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=9+Rue+pierre+pavoine,+72100+Le+Mans";
		$prix_base="65€TTC";
		$poele=false;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="50m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.3;

	}


else if ($logement==5) 
	{
		$lieu="rousseau";
		$lieuMAJ="RIF";
		$adresse_logement="3, rue du Rif 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=3+Rue+du+rif,+72100+Le+Mans";
		$prix_base="65€TTC";
		$poele=false;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="50m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.25;
	}

else if ($logement==6) 
	{
		$lieu="champion";
		$lieuMAJ="ATLAS";
		$adresse_logement="6, rue de l'Atlas 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=6+Rue+Atlas,+72100+Le+Mans";
		$prix_base="70€TTC";
		$poele=true;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="70m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.35;
	}

else if ($logement==7) 
	{
		$lieu="rousseau";
		$lieuMAJ="BROSSOLETTE";
		$adresse_logement="137, boulevard Brossolette 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=137+Boulevard+brossolette,+72100+Le+Mans";
		$prix_base="65€TTC";
		$poele=false;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="50m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.45;
	}


else if ($logement==8) 
	{
		$lieu="champion";
		$lieuMAJ="COURARD";
		$adresse_logement="9, rue Courard 72100 LE MANS";
		$adresse_google="https://maps.google.com/maps?q=9+Rue+pierre+pavoine,+72100+Le+Mans";
		$prix_base="65€TTC";
		$poele=false;
		$localisation="Parc des Expositions / Circuit des 24h";
		$surface="50m²";
		$type_logement="Maison";
		$nbre_chambre="2";
		$capacite="6 personnes";
		$max_nbre_personne=6;
		$icalfile = 'https://www.airbnb.fr/calendar/ical/11164515.ics?s=796849290a83d0f4bd6b5238d65eb4b4';
		$coef_prix= 1.5;
	}


?>