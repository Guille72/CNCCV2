<?php 
$_SESSION['nombre_de_logement']=8;


$date_arrivee_par_defaut=date('Y-m-d');
$date_depart_par_defaut=date('Y-m-d', strtotime('+3 day'));
$_SESSION['date_arrivee_par_defaut']=strtotime($date_arrivee_par_defaut);
$_SESSION['date_depart_par_defaut']=strtotime($date_depart_par_defaut);


//Politique d'annulation 
$_SESSION['nombre_jour_cancel_possible']=7; //possible d'annuler réservation sans pénalité x jours avant arrivée (x inclus)
$_SESSION['nombre_jour_no_cancel']=1; // PAS possible d'annuler réservation sans pénalité x jours avant arrivée (x inclus)
$_SESSION['penalite_annulation_modification_tardive']=0.5; //pourcentage de retenue sur facture si annul ou modif entre cancel_possible et no_cancel...

//Politique de remise commerciale
$_SESSION['remise_semaine']=0.12;
$_SESSION['remise_mois']=0.25;
$_SESSION['minimum_de_facturation']=20; // inséré pour qu'il n'y ait pas de transaction en deça de ce montant défini: ici à titre commercial et gain sur toute personne souhaitant modifier sa réservation pour l faire basculer de moins de 30 jours à plus de 30 jours. Nous préférons lui offrir des nuits issues de la remise au mois, plutôt que de lui "rembourser un trop perçu"...
$_SESSION['coef_prix_pers_supp']=0.30;
$_SESSION['forfait_menageTTC']=30;
$_SESSION['nombre_jour_menage']=8; //nombre de jours à compter desquels on prévoit un nouveau ménage
//nombre diviseur de jours pour 1 ménage, arrondit ensuite à l'entier supérieur

//Taxe
$_SESSION['taxe_de_sejour']=0.44;
$_SESSION['taux_TVA']=0.20;

$_SESSION['implantation_cnccv']='https://drive.google.com/open?id=1fuQA-DXZ6qUUcK_7pZ_eo0lu94M&usp=sharing';

?>