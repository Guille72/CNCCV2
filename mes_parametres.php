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
         
         <?php include('menu.php'); ?>
         </div>
                    <section class="section_logement" style="margin-top: 20px;margin-bottom: 20px;" >
                                                  
                             <form method="post" action="update_profil_membre.php" style="margin:0 auto;">
                               <fieldset>
                                   <legend style="text-align: center;color:#ff6959;font-size: 24px;">Voulez-vous mettre à jour votre profil ?</legend> 

                                       <label for="prenom" class="formulaire_label" >Prénom</label>
                                        <label for="nom" class="formulaire_label" style="margin-left: 100px;" >Nom</label>

                                        </br>
                                        <input type="text" name="prenom" id="prenom3" value="<?php echo htmlspecialchars($_SESSION['prenom']);?>"  class="formulaire_saisie"  novalidate/>
                                        <input type="text" name="nom" id="nom3" value="<?php echo htmlspecialchars($_SESSION['nom']);?>" class="formulaire_saisie"  novalidate/>
                                        </br>

                                       <label for="date_naissance" class="formulaire_label" >Date de naissance</label></br>
                                       <input type="date" name="date_naissance" id="date_naissance3" value="<?php echo htmlspecialchars($_SESSION['date_naissance']);?>" class="formulaire_saisie"  novalidate/>
                                        </br>
                                        <label for="adresse" class="formulaire_label" >Adresse</label></br>
                                       <input type="text" name="adresse" id="adresse3" style="width:300px" value="<?php echo htmlspecialchars($_SESSION['adresse']);?>" class="formulaire_saisie"  novalidate /></br>
                                        
                                        <label for="code_postal" class="formulaire_label">Code Postal</label>
                                        <label for="ville" class="formulaire_label" style="margin-left: 72px;" >Ville</label>
                                        </br>
                                        <input type="tel" name="code_postal" id="code_postal3" value="<?php echo htmlspecialchars($_SESSION['code_postal']);?>" class="formulaire_saisie"  novalidate/>
                                       <input type="text" name="ville" id="ville3" value="<?php echo htmlspecialchars($_SESSION['ville']);?>" class="formulaire_saisie"  novalidate />
                                       </br>

                                        <label for="mail" class="formulaire_label" >Mail</label> </br>
                                       <input type="mail" name="email" id="email3" value="<?php echo htmlspecialchars($_SESSION['email']);?>" class="formulaire_saisie"  novalidate/>
                                        </br>
                                        <label for="password" class="formulaire_label">Mot de passe</label>
                                       <label for="password_verif" class="formulaire_label" style="margin-left: 60px;">Confirmation</label>
                                       </br>
                                       <input type="password" name="password" id="password3" class="formulaire_saisie" />
                                       <input type="password" name="password_verif" id="password_verif3" class="formulaire_saisie"/>
                                        <input type="checkbox" name="changer_mdp_pro" id="change_password" />
                                        <label for="changer_mdp" class="formulaire_label">Changer mon mot de passe</label>
                                        
                                       </br>
                                       
                                        <label for="telephone" class="formulaire_label">Téléphone</label></br>
                                        <input type="tel" name="telephone" id="tel3" value="<?php echo htmlspecialchars($_SESSION['telephone']);?>" class="formulaire_saisie"  novalidate/></br>
                                        </br>
                                       <input type="submit" value="Mettre à jour mon profil" id="envoi3" class="submit" disabled="true" style="opacity:1;cursor:pointer;"/> 
                                       
                                      <!-- <input type="reset" id="rafraichir" value="Rafraichir" class="reset" /> -->

                                       </fieldset>
                                    </form>

                     <!-- <span style="margin:auto;"><img src="icones/client_modif.jpg"> </span>-->

                    
                    </section>

                    <div id="popup" class="white-popup mfp-hide" style="display:flex;flex-direction:column;width:30%;"> </div>
     
        
<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="magnific_popup/magnific_popup.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>

<script>
$(document).ready(function()
 {

var
        $password = $('#password3'),
        $password_verif = $('#password_verif3'),

        $ok_prenom3=true,
        $ok_nom3=true,
        $ok_adresse3=true,
        $ok_code_postal3=true,
        $ok_ville3=true,
        $ok_date_naissance3=false,
        $ok_email3=true,
        $ok_password3=true,
        $ok_password_verif3=true,
        $ok_tel3=true;


    $('#prenom3').bind("change keyup", function(){
        var prenomReg = /^[a-zA-Zéèç \-â]+$/;
        var prenomVal = $(this).val();
        if(!prenomReg.test(prenomVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_prenom3=false;
        autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_prenom3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_prenom3=true;
              autoriser3();
          } 
      });


  
    $('#nom3').bind("change keyup", function(){
        var nomReg = /^[a-zA-Zéèç \-â]+$/;
        var nomVal = $(this).val();
        if(!nomReg.test(nomVal)&& $(this).val()!='') {
                 $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_nom3=false;
        autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_nom3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_nom3=true;
              autoriser3();
          } 
      });



  $('#date_naissance3').bind("change keyup", function(){
    
      var
      $date_naissance=$(this).val();

      if((CheckDate($date_naissance) == false || diffdate($date_naissance) == false) && $(this).val()!='') {
              $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_date_naissance3=false;
        autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_date_naissance3=false;autoriser3();}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_date_naissance3=true;
              autoriser3();
          } 

    });


    $('#email3').bind("change keyup", function(){
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $(this).val();
        if(!emailReg.test(emailaddressVal)&& $(this).val()!='') {
               $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_email3=false;
        autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_email3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_email3=true;
              autoriser3();
          } 
      });

    $password.bind("change keyup", function(){
       if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue',color : 'black' });$ok_password3=false;autoriser3()}

        else if ($(this).val().length < 8){ // si la chaîne de caractères est inférieure à 8
            $(this).css({ BoxShadow : '2px 2px 3px red', color : 'red'  });
        $ok_password3=false;
        autoriser3();
            
         }
        else  {
              $(this).css({ BoxShadow : '2px 2px 3px green', color : 'black' });
              $ok_password3=true;
              autoriser3();
          } 
    });


    $password_verif.bind("change keyup", function(){
        if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue',color : 'black' });$ok_password_verif3=false;autoriser3()}

        else if($(this).val() != $password.val()){ // si la confirmation est différente du mot de passe
            $(this).css({ BoxShadow : '2px 2px 3px red', color : 'red'  });
              $ok_password_verif3=false;
              autoriser3();
         }
          
         else  {
              $(this).css({ BoxShadow : '2px 2px 3px green', color : 'green' });
              $ok_password_verif3=true;
              autoriser3();
          } 
    });


  $('#adresse3').bind("change keyup", function(){
        var adresseReg = /^[0-9a-zA-Zéèç \-â,]+$/;
        var adresseVal = $(this).val();
        if(!adresseReg.test(adresseVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_adresse3=false;
              autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_adresse3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_adresse3=true;
              autoriser3();
          } 
      });


  $('#code_postal3').bind("change keyup", function(){
        var code_postalReg = /^[0-9]{5,}$/;
        var code_postalVal = $(this).val();
        if(!code_postalReg.test(code_postalVal) && $(this).val()!='') {
                $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_code_postal3=false;
              autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_code_postal3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_code_postal3=true;
              autoriser3();
          } 
      });



    $('#ville3').bind("change keyup", function(){
        var villeReg = /^[a-zA-Zéèç \-â]+$/;
        var villeVal = $(this).val();
        if(!villeReg.test(villeVal) && $(this).val()!='') {
              $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_ville3=false;
              autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_ville3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_ville3=true;
              autoriser3();
          } 
      });


    $('#tel3').bind("change keyup", function(){
        var telReg = /^[0][0-9]{9,}$/;
        var telVal = $(this).val();
        if(!telReg.test(telVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_tel3=false;
              autoriser3();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_tel3=false;autoriser3()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_tel3=true;
              autoriser3();
          } 
      });
        
   var autorisation_change_password = function()
      {
         var n = $( "input:checked" ).length;
        if (n===1)
           {
            $('#password3').attr('disabled', false);
            $('#password3').attr('novalidate', true);
            $ok_password3=false;
            $('#password_verif3').attr('disabled', false);
            $('#password_verif3').attr('novalidate', true);
            $ok_password_verif3=false;
            autoriser3();
           }
           else
           {
            $('#password3').attr('disabled', true);
            $('#password3').val('');
            $('#password3').attr('novalidate', false);
            $('#password3').css({ BoxShadow : '0px 0px 0px lightblue' });
            $ok_password3=true; 
            $('#password_verif3').attr('disabled', true);
            $('#password_verif3').val('');
            $('#password_verif3').attr('novalidate', false);
            $('#password_verif3').css({ BoxShadow : '0px 0px 0px lightblue' });
            $ok_password_verif3=true;
            autoriser3();
         }
        };
        autorisation_change_password();
        $('#change_password').on('click',autorisation_change_password);

    function autoriser3() {
    if ($ok_prenom3==true && $ok_nom3 == true && $ok_adresse3==true && $ok_code_postal3==true && $ok_ville3==true && $ok_date_naissance3==true && $ok_email3==true && $ok_password3==true && $ok_password_verif3==true && $ok_tel3==true)
                {
                $('#envoi3').css({cursor :'pointer', opacity : '1'});
                $('#envoi3').attr('disabled', false);
                }
              else
                {
                $('#envoi3').css({cursor :'default', opacity : '0.6'});
                $('#envoi3').attr('disabled', true);
                }
        }

      function CheckDate(d) {
      // Cette fonction vérifie le format JJ/MM/AAAA saisi et la validité de la date.
      var amin=1900; // année mini
      var j=(d.substring(0,2));
      var m=(d.substring(3,5));
      var a=(d.substring(6));
    
        if ( ((isNaN(a))||(a<amin)) ) {
         return false;
        }

         var d2=new Date(a,m-1,j);
         j2=d2.getDate();
         m2=d2.getMonth()+1;
         a2=d2.getFullYear();
         if (a2<=100) {a2=1900+a2}
         if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
            return false;
         }
         else
         {
      return true;
         }
      }
 

    function diffdate(d) //Vérifie si + de 18 ans
    {
    var now=new Date();
    var annee   = now.getFullYear();
    var mois    = now.getMonth();
    var jour    = now.getDate();
    var d2= new Date(annee,mois,jour);

    var j=(d.substring(0,2));
        var m=(d.substring(3,5));
        var a=(d.substring(6));
        var d1=new Date(a,m-1,j);

    var WNbJours = d2.getTime() - d1.getTime();
    
    var nombre_jour = Math.ceil(WNbJours/(1000*60*60*24));
    if (nombre_jour>6574)
      { 
        return true;
      }
    else
      {
        return false;
      }
    }


 });            
</script>

</body>