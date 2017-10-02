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

                $dossier="CLIENTS/".$_SESSION['nom']." ".$_SESSION['prenom']."-".$_SESSION['id'];
                $contenu_dossier=scandir($dossier);
        ?> 

        </div>

        <div style="text-align: center;color:#ff6959;font-size:30px;background-color: white;width:80%;margin:0 auto;margin-top:20px">Ci-dessous l'ensemble de vos documents...</div> 
        <section id="section_reservation" style="display:flex;background-color: #FFFFFF;width:80%;margin:0 auto;margin-top:10px;border:none;">


        <?php
               $i=2;
               while (isset($contenu_dossier[$i])) {
                 $j=($i-2)%25;
                if ($j==0) {
                  ?>
                  <div>
                  <?php
                  }
                ?>
                
                 <a href="<?php echo $dossier;?>/<?php echo $contenu_dossier[$i];?>" style="margin-left:20px;font-style: normal;color:black;"><img src="icones/logopdf.jpg" width="20px" height="20px"> <?php echo $contenu_dossier[$i];?> </a></br>
                 <?php
                 
                  $j=($i-1)%25;
                                
                  if ($j==0) {
                  ?>
                  </div>
                  <?php
                  }

                  $i++;
               }

        ?> 
                            

          </section>

      




              
 
                    
        
<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>

<script src="magnific_popup/magnific_popup.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>

</body>