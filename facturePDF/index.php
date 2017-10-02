<?php
require('facturePDF.php');

// #1 initialise les informations de base
$aujourdhui=date('d/m/Y');// adresse de l'entreprise qui émet la facture
$adresse = "CNCCV SAS\n193, boulevard Jean-Jacques Rousseau\n72100 LE MANS\n\nguillaume@cnccv.fr\n(+33) 6 63 49 26 55";
// adresse du client
$adresseClient = "Nathalie LACAMBRE\n2, impasse Champion\n72100 LE MANS";
// initialise l'objet facturePDF
$pdf = new facturePDF($adresse, $adresseClient, "CNCCV SAS - 1 rue du Général Donk - 12321 Code Postal City - contact@general-zorg.fr - (+33) 3 89 68 27 54\nLes produits livrés demeurent la propriété exclusive de notre entreprise jusqu'au paiement complet de la présente facture.\nRCS : 245-532-578- NANCY / TVA Intracomunautaire : FR 02 4578 1455 5578 3254 / SIRET 887 547 259 974 125");
// défini le logo

$pdf->setLogo('logoSansCNCCV.png');
// entete des produits
$pdf->productHeaderAddRow('Produit', 75, 'L');
$pdf->productHeaderAddRow('Référence', 40, 'C');
$pdf->productHeaderAddRow('Prix HT', 25, 'C');
$pdf->productHeaderAddRow('QTE', 15, 'C');
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
$pdf->initFacture("Facture n° ".mt_rand(1, 99999)."-".mt_rand(1, 99999), "Le Mans le ".$aujourdhui, "Page 1");
// produit
$pdf->productAdd(array('Attrape mouche collant', 'C22M9', '10.00', '7', '70.00'));
$pdf->productAdd(array('Attrape mouche collant CRAFT', 'C42M3', '5.00', '7', '35.00'));
$pdf->productAdd(array('Cylindre Honda ZX10R 125cc à carburateur injecté et intégration de cartouche NOS 2.6 vag-7', 'K345', '2.95', '1', '2.95'));
$pdf->productAdd(array('Baume du tigre rouge 3gr', 'BT45', '54.95', '1', '54.95'));
$pdf->productAdd(array('Batterie GoPro Hero 3 2044 mAh', 'SNCF', '0.99', '9', '9.91'));
$pdf->productAdd(array('Pack Pépito Super Promo Collector 25th anniversary', 'Gift-81', '37,00', '1', '37,00'));

// ligne des totaux
$pdf->totalAdd(array('Total HT', '59.95 EUR'));
$pdf->totalAdd(array('TVA', '10.99 EUR'));
$pdf->totalAdd(array('Sous total TTC', '71.94 EUR'));
$pdf->totalAdd(array('Livraison', '100.00 EUR'));
$pdf->totalAdd(array('Remise', '-5.94 EUR'));
$pdf->totalAdd(array('Total TTC', '165.00 EUR'));

// #3 Importe le gabarit
//
require('gabarit'.intval($_GET['id']).'.php');

// #4 Finalisation
// construit le PDF
$pdf->buildPDF();
// télécharge le fichier
$pdf->Output('Facture.pdf', 'I');
?>