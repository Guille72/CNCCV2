<?php  session_start();  
error_reporting( E_ALL );

include("parametre_general_tarif.php");

require("fonction.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="fr"/>

    <?php $xajax->printJavascript(); /* Affiche le Javascript */?>

    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
     <link rel="stylesheet" media="screen" type="text/css" title="Design" href="calendrier.css" /> 
    <link rel="stylesheet" href="jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="magnific_popup/magnific_popup.css">  
    <link rel="shortcut icon" href="images/logoSansCNCCV.png">
  
    <title>Chez Nous comme Chez Vous - Location de maisons meublées au Mans</title>
  </head>
 <body onload="xajax_page_de_demarrage();">
        
        <?php include('menu.php'); ?> 
        <!--  ci-dessus le header -->

        <div class="position_menu_dispo">
                      <form action="">
                         <fieldset class="position_contenu_menu_dispo">
                                
                                <div class="style_champ_dispo">
                                    <label for="from" class="menu_depart" ></label>     
                                    <input type="text" id="from" name="from" class="from champ_dispo" placeholder="Arrivée" />
                                </div>
                                <div class="style_champ_dispo">
                                    <label for="to" class="menu_depart"></label>
                                    <input type="text" id="to" name="to" class="to champ_dispo" placeholder="Départ"/>
                                 </div>
                                 <div class="style_champ_dispo"> 
                                  <label for="nombre_personne" class="menu_depart"></label>
                                    <input type="number" id="nombre_personne" name="nombre_personne" class="champ_dispo" min="1" max="6" step="1" placeholder="Voyageurs" />
                                    <input type="submit" id="verifier" value="Vérifier" class="champ_dispo" style="background-color:#ff6959; color:white;margin-left: 20px;cursor:pointer;opacity: 1;width:140px;" onclick="xajax_afficher_dispo_prix(document.getElementById('from').value,document.getElementById('to').value,document.getElementById('nombre_personne').value);return false;" disabled="true" /> 
                              </div>
                                                           
                         </fieldset>
                    </form>
         </div>



        <div style="color:grey;font-size:1.2em;margin-left:100px;font-weight: normal;margin-top: 0px;"> Entrez vos dates de séjour, le nombre de voyageurs... Réservez...</div>
        <div style="color:rgb(255,170,89);font-size:1.4em;text-align:center;font-weight: bold;font-style:normal;">... Et bon séjour dans nos maisons au Mans !</div>
        
        </div>
        
        <div id="page_de_demarrage" style="margin-left:30px;color:rgb(57,141,157);font-size:1.0em;"></div>

        <div id="affichage" style="margin-top: 30px;" ></div>

                                            
        <div id="popup_connexion" class="white-popup mfp-hide" style="display:flex;width:80%;">
          <div class="element" style="border:none;">
              <form method="post" action="login.php">
                
                      <!-- <div style="text-align: center;color:#ff6959;font-size: 24px;">Mon Compte</div> -->
                      <!-- </br> -->

                         <label for="mail" class="formulaire_label" size = "100">Mail</label>
                        </br>
                         <input type="mail" name="email" id="email_login" class="formulaire_saisie" novalidate/>
                         </br>
                         </br>
                         <label for="password_choose" class="formulaire_label" >Mot de passe</label>
                         </br>
                        <input type="password" name="password" id="password_login" class="formulaire_saisie"  novalidate/>
                        </br>
                        
                        <div style="text-align: right;"><a href="mot_de_passe_oublie.php" style="color: gray;font-size: 15px; font-style: normal;">Mot de passe oublié ?</a></div>
                        </br>
                        
                        <div style="text-align: center;"><input type="submit" value="Se connecter" id="envoi_login" class="submit" disabled="true" /></div>
                     </form>  
              </div> 
                        
              <div class="element" style="border:none;color:#ff6959;">
                         </br>
                        </br>

                        Pas encore de compte ?
                        </br>
                        </br>
                        <div style="text-align: center;"><button href="#popup_inscription" class="open_popup button_inscription">Inscrivez-vous</button></div>
              </div>
              <div class="element" style="border:none;color:#ff6959;">
                      
                      Accès partenaire

              </div>

        </div>    
          

                  
        <div id="popup_inscription" class="white-popup mfp-hide">
                            
                             <form method="post" action="inserer_membre.php" enctype="multipart/form-data">
                               <fieldset style="background: url(icones/yes_dispo2.jpg) right bottom no-repeat;background-size: 50%;">
                                   
                                    <div style="text-align: center;color:#ff6959;font-size: 1.5em;"> Merci pour votre inscription ! </div>
                                    <div style="text-align: center;color:#ff6959;font-size: 0.8em;"> Pour vous inscrire, vous devez avoir <u>plus de 18 ans</u>... </div>
                                            </br>
                                            <label for="prenom" class="formulaire_label" >Prénom</label>
                                            <label for="nom" class="formulaire_label" style="margin-left: 103px;" >Nom</label>
                                            </br>
                                            <input type="text" name="prenom" id="prenom"  class="formulaire_saisie"  novalidate/>
                                            <input type="text" name="nom" id="nom" class="formulaire_saisie"  novalidate/>
                                            </br>
                                        <label for="date_naissance" class="formulaire_label" >Date de naissance</label></br>
                                       <input type="date" name="date_naissance" id="date_naissance" placeholder="jj/mm/aaaa" class="formulaire_saisie" novalidate/></br>

                                        <label for="adresse" class="formulaire_label" >Adresse</label></br>
                                       <input type="text" name="adresse" id="adresse" class="formulaire_saisie" style="width:300px" novalidate /></br>
                                        
                                        <label for="code_postal" class="formulaire_label">Code Postal</label><label for="ville" class="formulaire_label" style="margin-left: 78px;">Ville</label></br>
                                        <input type="tel" name="code_postal" id="code_postal" class="formulaire_saisie" novalidate/>
                                       
                                       
                                       <input type="text" name="ville" id="ville" class="formulaire_saisie" novalidate /></br>

                                        <label for="mail" class="formulaire_label" >Mail</label></br>
                                       <input type="mail" name="email" id="email" class="formulaire_saisie" novalidate/></br>
                                       
                                       <label for="password" class="formulaire_label"> Mot de passe</label><label for="password_verif" class="formulaire_label" style="margin-left: 62px;"> Confirmation </label>
                                       </br>
                                       <input type="password" name="password" id="password" class="formulaire_saisie" novalidate/>
                                       <input type="password" name="password_verif" id="password_verif" class="formulaire_saisie" novalidate/></br>
                                        
                                        <label for="telephone" class="formulaire_label">Téléphone</label></br>
                                        <input type="tel" name="telephone" id="tel" class="formulaire_saisie" novalidate/></br>
                                       </br>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                                               <label for="cni" class="formulaire_label">Votre pièce d'identité (CNI ou passeport) : </label></br>
                                               <input type="file" name="cni" id="cni" class="formulaire_saisie"/></br>
                                               </br>

                                       <input type="submit" value="Devenez Membre" id="envoi" class="submit" disabled="true" style="margin-left: 100px;" /> 
                                      
                                       <!--<input type="reset" id="rafraichir" value="Rafraichir" class="reset" />-->

                                       </fieldset>
                                    </form>
                              
                    </div>



            <div id="popup_calendrier" class="white-popup mfp-hide" style="display:flex;flex-direction:column;max-width: 850px;"> </div>

            <div id="popup" class="white-popup mfp-hide" style="display:flex;flex-direction:column;width:30%;"> </div>


<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="magnific_popup/magnific_popup.js"></script>
<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script>
$(document).ready(function()
 {

      jQuery(function($){
                              $.datepicker.regional['fr'] = {
                                closeText: 'Fermer',
                                prevText: '&#x3c;Préc',
                                nextText: 'Suiv&#x3e;',
                                currentText: 'Aujourd\'hui',
                                monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                                'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
                                monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                                'Jul','Aou','Sep','Oct','Nov','Dec'],
                                dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                                dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                                dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
                                weekHeader: 'Sm',
                                dateFormat: 'dd/mm/yy',
                                firstDay: 1,
                                isRTL: false,
                                showMonthAfterYear: false,
                                yearSuffix: '',
                                minDate: 0,
                                maxDate: '+12M +0D',
                                numberOfMonths: 1,
                                showButtonPanel: true
                                };
                              $.datepicker.setDefaults($.datepicker.regional['fr']);
                            });
                            
      $( function() {
                                var dateFormat = "dd/mm/yy",
                                  from = $( ".from" )
                                    .datepicker({
                                      defaultDate: "+1w",
                                      changeMonth: false,
                                      numberOfMonths: 2
                                    })
                                    .on( "change", function() {
                                      to.datepicker( "option", "minDate", getDate( this ) );
                                    }),
                                  to = $( ".to" ).datepicker({
                                    defaultDate: "+1w",
                                    changeMonth: false,
                                    numberOfMonths: 2
                                  })
                                  // .on( "change", function() {
                                  //   from.datepicker( "option", "maxDate", getDate( this ) );
                                  // });
                             
                                function getDate( element ) {
                                  var date;
                                  try {
                                    date = $.datepicker.parseDate( dateFormat, element.value );
                                  } catch( error ) {
                                    date = null;
                                  }
                             
                                  return date;
                                }
                              } );
              //fin du date picker              

  $('.open-popup-link').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });


  $('#from').bind("change keyup blur", function(){
      

      var
      $from=$(this).val();
      $to=$('#to').val();


        autoriser_verifier($from,$to);
    });



  $('#to').bind("change keyup blur", function(){
    
      var
      $from=$('#from').val();
      $to=$(this).val();
      
        autoriser_verifier($from,$to); 
    });



  function autoriser_verifier($from,$to) {
  
        if(CheckDate($from) == false || CheckDate($to) == false || diffdate_arrivee($from) == false || diffdate_depart($from,$to) == false)  {
              $('#from').css({ BoxShadow : '2px 2px 3px red' });
              $('#to').css({ BoxShadow : '2px 2px 3px red' });  
              $('#verifier').css({cursor :'default', opacity : '0.6'});
              $('#verifier').attr('disabled', true);
          } 
          
          else  {
              $('#from').css({ BoxShadow : '2px 2px 3px green' });
              $('#to').css({ BoxShadow : '2px 2px 3px green' });
              $('#verifier').css({cursor :'pointer', opacity : '1'});
              $('#verifier').attr('disabled', false);
          } 
              
        }


    function diffdate_arrivee(d) //vérifie que date arrivée >= à aujourd'hui
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

    var WNbJours = d1.getTime() - d2.getTime();
    
    var nombre_jour = Math.ceil(WNbJours/(1000*60*60*24));
    if (nombre_jour>=0)
      { 
        return true;
      }
    else
      {
        return false;
      }
    }

    function diffdate_depart(da,dd) //Vérifie que au moins un jour de différence
    {
    
    var jj=(da.substring(0,2));
        var mm=(da.substring(3,5));
        var aa=(da.substring(6));
    var d2= new Date(aa,mm-1,jj);

    var j=(dd.substring(0,2));
        var m=(dd.substring(3,5));
        var a=(dd.substring(6));
        var d1=new Date(a,m-1,j);

    var WNbJours = d1.getTime() - d2.getTime();
    
    var nombre_jour = Math.ceil(WNbJours/(1000*60*60*24));
    if (nombre_jour>=1)
      { 
        return true;
      }
    else
      {
        return false;
      }
    }


    $('.image-popup-fit-width').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      image: {
        verticalFit: false
      }
    });


        $('.open_popup').magnificPopup({
        type:'inline',
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });

  

var     $password_login = $('#password_login'),
    $ok_email_login=false,
        $ok_password_login=false;

       
  $('#email_login').bind("change keyup", function(){
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          var emailaddressVal = $(this).val();
          if(!emailReg.test(emailaddressVal) && $(this).val()!='') {
                $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_email_login=false;
              $('#envoi_login').css({cursor :'default', opacity : '0.6'});
              $('#envoi_login').attr('disabled', true);
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_email_login=false;}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_email_login=true;
              if ($ok_email_login==true && $ok_password_login == true) 
                {
                $('#envoi_login').css({cursor :'pointer', opacity : '1'});
                $('#envoi_login').attr('disabled', false);
                
                }
              else
                {
                $('#envoi_login').css({cursor :'default', opacity : '0.6'});
                $('#envoi_login').attr('disabled', true);
                }
          } 
      });

  $password_login.bind("change keyup", function(){
        if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue',color : 'black' }); $ok_password_login=false;}

        else if ($(this).val().length < 8){ // si la chaîne de caractères est inférieure à 8
            $(this).css({ BoxShadow : '2px 2px 3px red', color : 'red'  });
            $('#envoi_login').css({cursor :'default', opacity : '0.6'});
            $('#envoi_login').attr('disabled', true);

            $ok_password_login=false;
         }
          
         else  {
              $(this).css({ BoxShadow : '2px 2px 3px green', color : 'black' });
              $ok_password_login=true;
              if ($ok_email_login==true && $ok_password_login == true) 
                {
                $('#envoi_login').css({cursor :'pointer', opacity : '1'});
                $('#envoi_login').attr('disabled', false);
                }
              else
                {
                $('#envoi_login').css({cursor :'default', opacity : '0.6'});
                $('#envoi_login').attr('disabled', true);
                }
          } 
    });


var
        $password = $('#password'),
        $password_verif = $('#password_verif'),
 
       // $date_naissance = $('date_naissance'),

      $envoi=$('#envoi'),
        $reset = $('#rafraichir'),

        $connexion = $('.connexion'),

        $ok_prenom=false,
        $ok_nom=false,
        $ok_adresse=false,
        $ok_code_postal=false,
        $ok_ville=false,
        $ok_date_naissance=false,
        $ok_email=false,
        $ok_password=false,
        $ok_password_verif=false,
        $ok_tel=false,
        $ok_cni=false;


    $('#prenom').bind("change keyup", function(){
        var prenomReg = /^[a-zA-Zéèç \-â]+$/;
        var prenomVal = $(this).val();
        if(!prenomReg.test(prenomVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_prenom=false;
        autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_prenom=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_prenom=true;
              autoriser();
          } 
      });


  
    $('#nom').bind("change keyup", function(){
        var nomReg = /^[a-zA-Zéèç \-â]+$/;
        var nomVal = $(this).val();
        if(!nomReg.test(nomVal)&& $(this).val()!='') {
                 $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_nom=false;
        autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_nom=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_nom=true;
              autoriser();
          } 
      });



  $('#date_naissance').bind("change keyup", function(){
    
      var
      $date_naissance=$(this).val();

      if((CheckDate($date_naissance) == false || diffdate($date_naissance) == false) && $(this).val()!='') {
              $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_date_naissance=false;
        autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_date_naissance=false;autoriser();}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_date_naissance=true;
              autoriser();
          } 

    });


    $('#email').bind("change keyup", function(){
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $(this).val();
        if(!emailReg.test(emailaddressVal)&& $(this).val()!='') {
               $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_email=false;
        autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_email=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_email=true;
              autoriser();
          } 
      });



  $('#email_mdp_oublie').bind("change keyup", function(){
          var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          var emailaddressVal = $(this).val();
          if(!emailReg.test(emailaddressVal)) {
              $erreur_login.text('Attention Erreur sur votre adresse email !!');
              $erreur_login.css({ color : 'blue'});
             $('#email_mdp_oublie').val('');
          } else  {
              $erreur_login.text('');
              $('#envoi_mdp_oublie').attr('disabled', false);
          } 
      });




    $password.bind("change keyup", function(){
       if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue',color : 'black' });$ok_password=false;autoriser()}

        else if ($(this).val().length < 8){ // si la chaîne de caractères est inférieure à 8
            $(this).css({ BoxShadow : '2px 2px 3px red', color : 'red'  });
        $ok_password=false;
        autoriser();
            
         }
        else  {
              $(this).css({ BoxShadow : '2px 2px 3px green', color : 'black' });
              $ok_password=true;
              autoriser();
          } 
    });


    $password_verif.bind("change keyup", function(){
        if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue',color : 'black' });$ok_password_verif=false;autoriser()}

        else if($(this).val() != $password.val()){ // si la confirmation est différente du mot de passe
            $(this).css({ BoxShadow : '2px 2px 3px red', color : 'red'  });
              $ok_password_verif=false;
              autoriser();
         }
          
         else  {
              $(this).css({ BoxShadow : '2px 2px 3px green', color : 'green' });
              $ok_password_verif=true;
              autoriser();
          } 
    });


  $('#adresse').bind("change keyup", function(){
        var adresseReg = /^[0-9a-zA-Zéèç \-â,]+$/;
        var adresseVal = $(this).val();
        if(!adresseReg.test(adresseVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_adresse=false;
              autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_adresse=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_adresse=true;
              autoriser();
          } 
      });


  $('#code_postal').bind("change keyup", function(){
        var code_postalReg = /^[0-9]{5,}$/;
        var code_postalVal = $(this).val();
        if(!code_postalReg.test(code_postalVal) && $(this).val()!='') {
                $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_code_postal=false;
              autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_code_postal=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_code_postal=true;
              autoriser();
          } 
      });



    $('#ville').bind("change keyup", function(){
        var villeReg = /^[a-zA-Zéèç \-â]+$/;
        var villeVal = $(this).val();
        if(!villeReg.test(villeVal) && $(this).val()!='') {
              $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_ville=false;
              autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_ville=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_ville=true;
              autoriser();
          } 
      });


    $('#tel').bind("change keyup", function(){
        var telReg = /^[0][0-9]{9,}$/;
        var telVal = $(this).val();
        if(!telReg.test(telVal)&& $(this).val()!='') {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
              $ok_tel=false;
              autoriser();
          } 
          else if ($(this).val()=='')
            {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_tel=false;autoriser()}
          else  {
              $(this).css({ BoxShadow : '2px 2px 3px green' });
              $ok_tel=true;
              autoriser();
          } 
      });

    $('#cni').bind("change keyup", function(){
        var fileName = $(this).val();
        if(fileName.length == 0) {
             $(this).css({ BoxShadow : '2px 2px 3px red' });
                $ok_cni=false;
              autoriser();
            } 
            else if ($(this).val()=='')
                {$(this).css({ BoxShadow : '2px 2px 3px lightblue' }); $ok_cni=false;autoriser()}
            else  {
                $ok_cni=true;
                $(this).css({ BoxShadow : '2px 2px 3px green' });
                autoriser();
            } 
        });

    $reset.click(function(){$('.formulaire_saisie').css({ BoxShadow : '0px 0px 0px lightblue', color :'black' });});
        


    function autoriser() {
    if ($ok_prenom==true && $ok_nom == true && $ok_adresse==true && $ok_code_postal==true && $ok_ville==true && $ok_date_naissance==true && $ok_email==true && $ok_password==true && $ok_password_verif==true && $ok_tel==true && $ok_cni==true)
                {
                $envoi.css({cursor :'pointer', opacity : '1'});
                $envoi.attr('disabled', false);
                }
              else
                {
                $envoi.css({cursor :'default', opacity : '0.6'});
                $envoi.attr('disabled', true);
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
</html>              
  
            

    
