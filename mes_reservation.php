<?php  session_start();  
error_reporting( E_ALL );

include("parametre_general_tarif.php");

include("fonction.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="fr"/>

    <?php $xajax->printJavascript(); /* Affiche le Javascript */?>

    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="carroussel.css" />
     <link rel="stylesheet" media="screen" type="text/css" title="Design" href="calendrier.css" /> 
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="magnific_popup/magnific_popup.css">  
    <link rel="shortcut icon" href="images/logoSansCNCCV.png">
  
    <title>Chez Vous comme Chez Nous - Location meublée au Mans</title>
  </head>
 <body>
       
        <?php
                include('menu.php');

                include("bdd_connect.php");
                include("recap_reservation_commentaire.php");
        ?> 

            </div>
                    <section class="section_reservation" style="box-shadow: 0px 0px 6px lightblue;">

                            <div style="padding-left:40px;padding-top:20px;color:#ff6959;font-size: 1.5em;font-weight: bold;">VOS RESERVATIONS PASSEES</div>
                                  
                                  <?php
                            $no_reservation=0;
                            for ($logement=1; $logement<= $_SESSION['nombre_de_logement']; $logement++)
                            {
                                  include("logements_presentation.php");
                                  
                                  if ($_SESSION['a_commenter_'.$lieu]==true)
                                  {
                                      $lieu_MAJ=strtoupper($lieu);
                                       $date_depart= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['date_depart_'.$lieu]);
                                       $num_reservation=$_SESSION['num_reservation_commentaire_'.$lieu];

                                  ?>
                                    <div style="padding-left:40px;padding-top:10px;padding-bottom:10px;color:#ff6959;font-size: 1.2em;font-style: italic;font-weight: bold;">Chez <?php echo $lieu_MAJ;?></div>
                                    <div style="display: flex; justify-content: space-between;">
                                    <span style="padding-left:40px;padding-top:10px;padding-bottom:10px;align-content: left;">Merci pour votre séjour chez <b><?php echo $lieu_MAJ;?></b> le <b><?php echo $date_depart;?> </b> ! 
                                    <input type="submit" value="Laissez-nous un commentaire !" style="cursor:pointer;opacity: 1;margin-left: 30px;" onclick="xajax_ecrire_commentaire(<?php echo $num_reservation;?>,<?php echo $logement;?>);" /></br>
                                    <div  style="text-align: center;color:grey;margin-top: 10px;">__________________________________________________</div></span>

                                         
                                   <!--    <span style="align-content: left;padding-right: 150px;">
                                                                                                      
                                       
                                      </span> -->
                                    </div>
                                   
                                    <?php
                                    } 
                                    else {
                                    $no_reservation=1+$no_reservation;
                                    } 
  
                               }           
                                if ($no_reservation==$_SESSION['nombre_de_logement']){
                       ?>    
                                    <span style="padding-left:40px;padding-top:10px;padding-bottom:40px;align-content: left;">Vous avez commenté toutes vos réservations passées, ou vous n'avez pas de réservation passées...  </span>
                        <?php
                                }
                        ?>

                    </section>
      


                    <section class="section_reservation" style="box-shadow: 0px 0px 6px lightblue;">

                                  <div style="padding-left:40px;padding-top:20px;color:#ff6959;font-size: 1.5em;font-weight: bold;">VOS RESERVATIONS ACTUELLES</div>
                                  <div style="padding-left:40px;color:#ff6959;font-size: 1.0em;">Tous vos documents : avoirs, factures de suppléments, devis sont <a href="mes_documents.php" style="color:#ff6959;font-style: normal;text-decoration: underline;font-weight:bold;">ici</a></div>
                                  <?php
                            $no_reservation=0;
                            for ($logement=1; $logement<= $_SESSION['nombre_de_logement']; $logement++)
                            {
                                  include("logements_presentation.php");
                                  
                                  if (isset($_SESSION['resa_'.$lieu.'1'][0]))
                                    {
                                      $i=1;
                                      $lieu_MAJ=strtoupper($lieu);
                                  ?>
                                    <div style="padding-left:40px;padding-top:10px;padding-bottom:10px;color:#ff6959;font-size: 1.2em;font-style: italic;font-weight: bold;">Chez <?php echo $lieu_MAJ;?></div>
                                  <?php
                                      
                                      while(isset($_SESSION['resa_'.$lieu.$i][0]))
                                          {
                                  
                                            $date_arrivee= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['resa_'.$lieu.$i][0]);
                                            $date_depart= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['resa_'.$lieu.$i][1]);
                                             $date_resa=strtotime($_SESSION['resa_'.$lieu.$i][9]);
                                             $date_resa=date('ymd',$date_resa);
                                             $numero_piece=$logement.'-'.$date_resa.'-'.$_SESSION['id'].'-'.$_SESSION['resa_'.$lieu.$i][3];   

                                    ?>
                                        
                                            <div style="display: flex; justify-content: space-between;">
                                                <span style="padding-left:40px;padding-top:10px;padding-bottom:10px;align-content: left;">
                                               
                                                  Du : <?php echo $date_arrivee;?> Au : <?php echo $date_depart;?> pour <?php echo $_SESSION['resa_'.$lieu.$i][2];?> personne(s)</br>
                                                  Prix : <?php echo $_SESSION['resa_'.$lieu.$i][5];?> euros TTC </br>
                                                  <a href="Factures/Facture CNCCV <?php echo $numero_piece;?>.pdf" style="font-style:normal;color:black;">Votre Facture n° : <?php echo $numero_piece;?> <img src="icones/logopdf.jpg" width="20px" height="20px"></a>
                                                <div  style="text-align: right;color:grey;">______________________________________________</div></span>

                                                <?php
                                                    if (!isset($_SESSION['resa_'.$lieu.$i][6]))
                                                    {
                                                    $date_arrivee_mod= strtotime($_SESSION['resa_'.$lieu.$i][0]);
                                                    $date_depart_mod= strtotime($_SESSION['resa_'.$lieu.$i][1]);
                                                    $num_reservation= $_SESSION['resa_'.$lieu.$i][3];
                                                    $nb_personne=$_SESSION['resa_'.$lieu.$i][2];

                                                ?>
                                                      <span style="align-content: right;padding-right: 100px;padding-top:10px;">
                                                                                                      
                                                          <input type="submit" value="Annuler ma réservation <?php echo $num_reservation;?>" style="cursor:pointer;opacity: 1;" onclick="xajax_demande_annuler(<?php echo $num_reservation;?>,<?php echo $i;?>,<?php echo $logement;?>);" />
                                                          </br>                                              
                                                          </br>   
                                                          <input type="submit" value="Modifier ma réservation <?php echo $num_reservation;?>" style="cursor:pointer;opacity: 1;" onclick="xajax_demande_modifier(<?php echo $date_arrivee_mod;?>,<?php echo $date_depart_mod;?>,<?php echo $nb_personne;?>,<?php echo $i;?>,<?php echo $logement;?>);" /></br></br>
                                                      </span>
                                                    <?php
                                                      }
                                                      else
                                                      {
                                                        $date_annulation= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['resa_'.$lieu.$i][6]);
                                                    ?>
                                                           <span style="align-content: right;padding-right: 100px;color:grey"></br>
                                                                Réservation annulée le <?php echo $date_annulation;?>
                                                           </span>
                                                    <?php
                                                      }

                                                    ?>
                                              </div>
                                            
                                    <?php
                                          $i=$i+1;
                                          }
                                    }
                                   else {                                    
                                     $no_reservation=1+$no_reservation;
                                    } 
  
                               }           
                                if ($no_reservation==2){
                       ?>    
                                    <span style="padding-left:40px;padding-top:10px;padding-bottom:10px;align-content: left;">Vous n'avez pas de réservation en cours...  </span>
                        <?php
                                }
                        ?>

                    </section>

                    <div id="popup" class="white-popup mfp-hide" style="display:flex;flex-direction:column;width:30%;"> </div>




              
 
                    
        
<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>

<script src="magnific_popup/magnific_popup.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>

</body>