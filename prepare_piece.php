<?php


$prixTTC=$prixTOTAL-$taxe_de_sejour;
$prix_menageHT=round($forfait_menageTTC/(1+$_SESSION['taux_TVA']),2,PHP_ROUND_HALF_UP);
$prixHT=round(($prixTTC-$forfait_menageTTC)/(1+$_SESSION['taux_TVA']),2,PHP_ROUND_HALF_UP);
$prixTOTALHT=$prixHT+$prix_menageHT;
$TVA=$prixTTC-$prixHT-$prix_menageHT;


$lieu=strtoupper($lieu);

$prixTOTAL=number_format($prixTOTAL, 2, ',', ' ');
$taxe_de_sejour=number_format($taxe_de_sejour, 2, ',', ' ');
$prixTTC=number_format($prixTTC, 2, ',', ' ');
$prix_menageHT= number_format($prix_menageHT, 2, ',', ' ');
$prixHT=number_format($prixHT, 2, ',', ' ');
$prixTOTALHT=number_format($prixTOTALHT, 2, ',', ' ');
$TVA=number_format($TVA, 2, ',', ' ');


    require('facturePDF/facturePDF.php');

    // #1 initialise les informations de base
    $aujourdhui=date('d/m/Y');// adresse de l'entreprise qui émet la facture
    $adresse_CNCCV = "CNCCV SAS\n193, boulevard Jean-Jacques Rousseau\n72100 LE MANS\n\nguillaume@cnccv.fr\n(+33) 6 63 49 26 55\nwww.cnccv.fr";
    // adresse du client
    $adresseClient = $prenom." ".$nom."\n".$adresse."\n".$code_postal." ".$ville."\n".$telephone;
    // initialise l'objet facturePDF
    $pdf = new facturePDF($adresse_CNCCV, $adresseClient, "CNCCV, SAS au capital de 10.000 euros, sise 193, boulevard Jean-Jacques Rousseau, 72100 LE MANS inscrite au RCS du Mans 123 456 789 \nTVA Intracomunautaire : FR 02 4578 1455 5578 3254 / SIRET 123 456 789 00011");

    // défini le logo

    $pdf->setLogo('images/logoSansCNCCV.png');
    // entete des produits
    $pdf->productHeaderAddRow('Votre réservation', 75, 'L');
    $pdf->productHeaderAddRow('-', 40, 'C');
    $pdf->productHeaderAddRow('-', 25, 'C');
    $pdf->productHeaderAddRow('-', 15, 'C');
    $pdf->productHeaderAddRow('Prix HT', 25, 'R');
    // entete des totaux
    $pdf->totalHeaderAddRow(40, 'L');
    $pdf->totalHeaderAddRow(30, 'R');
    // element personnalisé
    $pdf->elementAdd('', 'traitEnteteProduit', 'content');
    $pdf->elementAdd('', 'traitBas', 'footer');

    // #2 Créer une facture
    //
    // numéro de facture, date, texte avant le numéro de page
    $pdf->initFacture($type_piece.$numero_piece, "Le Mans le ".$aujourdhui, "Page 1");
    // produit
    $pdf->productAdd(array($nombre_nuit.' nuit(s) Chez '.$lieu, '-', '-', '-', $prixHT));
    $pdf->productAdd(array('Forfait ménage pour '.$nombre_menage.' ménage(s) durant le séjour (inclu remplacement draps et serviettes)', '-', '-', '-', $prix_menageHT));
    $pdf->productAdd(array('Du '.$date_arrivee.' au '.$date_depart, '-', '-', '-', '-'));
    $pdf->productAdd(array('Pour '.$nbre_personne.' personne(s)', '-', '-', '-', '-'));
    if (isset($numero_piece_origine)) {
    	$pdf->productAdd(array('N° Facture d\'origine :'.$numero_piece_origine, '-', '-', '-', '-'));
    	}
    	else {
    	$pdf->productAdd(array('Rendez-vous au :'.$adresse_logement_piece, '-', '-', '-', '-'));
		}
    // ligne des totaux
    $pdf->totalAdd(array('Total HT', $prixTOTALHT.' EUR'));
    $pdf->totalAdd(array('TVA', $TVA.' EUR'));
    $pdf->totalAdd(array('Sous total TTC', $prixTTC.' EUR'));
    $pdf->totalAdd(array('-', '-'));
    $pdf->totalAdd(array('Taxe de Séjour', $taxe_de_sejour.' EUR'));
    $pdf->totalAdd(array('-', '-'));
    $pdf->totalAdd(array('Total à régler', $prixTOTAL.' EUR'));

    // #3 Importe le gabarit
    //
    require('facturePDF/gabarit1.php');

    // #4 Finalisation
    // construit le PDF
    $pdf->buildPDF();
?>