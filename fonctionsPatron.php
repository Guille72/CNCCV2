<?php

function page_de_demarrage()
{
    $reponse = new xajaxResponse();


// ci-dessous va chercher au moins 3 logements disponibles sur des dates définies aléatoirement MAIS en partant d'aujourd'hui

    $num_reservation=0;
    $nbre_personne=rand(1,4);
    $nbj_alea=rand(3,9);
    $i=0;
    $n=0;
    while ($i<=3)
    {
        $m=$n+$nbj_alea;
        $date_arrivee_sql=date('Y-m-d', strtotime('+'.$n.' day'));
        $date_depart_sql=date('Y-m-d', strtotime('+'.$m.' day'));
        $i=0;
        for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
        {
            $dispo=dispo_logement($date_arrivee_sql,$date_depart_sql,$num_reservation,$logement);

            if ($dispo ==true) {$i++;}
        }
        $n++;
    }


// lignes ci-dessous permettent de passer du format Y-m-d au format d/m/Y
    $date_arrivee=strtotime($date_arrivee_sql); // ressort le nombre de secondes depuis 01/01/1970 de la date contenu dans la variable $date_arrivee_sql
    $date_depart=strtotime($date_depart_sql);
    $date_arrivee_fr = date("d/m/Y",$date_arrivee);
    $date_depart_fr = date("d/m/Y",$date_depart);

// chargement de la phrase associée à la page de démarrage
    $content='<span>Exemple de tarif ci-dessous pour la période du <b>'.$date_arrivee_fr.'</b> au <b>'.$date_depart_fr.'</b> pour <b>'.$nbre_personne.'</b> personne(s)</span>';

    $_SESSION['page_de_demarrage']=1;

    $reponse->assign('page_de_demarrage','innerHTML',$content);
    $reponse->script('xajax_afficher_dispo_prix('.$date_arrivee.','.$date_depart.','.$nbre_personne.')');
    return $reponse;
}


function afficher_dispo_prix($date_arrivee,$date_depart,$nbre_personne)
{
    $reponse = new xajaxResponse();

    //permet de supprimer la phrase de démarrage si l'utilisateur a mis lui même ses données d'arrivée et départ
    if ($_SESSION['page_de_demarrage']==0) {$reponse->assign('page_de_demarrage','innerHTML','');}
    if ($_SESSION['page_de_demarrage']==1) {$_SESSION['page_de_demarrage']=0;}
    //met à 1 si la personne a oublié de mentionner le nombre de voyageurs
    if ($nbre_personne==null) {$nbre_personne=1; $reponse->script('document.getElementById(\'nombre_personne\').value=1;');}

    //vérification des données d'entrée
    $verif = preg_match("#/#", $date_arrivee); //vérifie si le format de date arrivée est dd/mm/yyyy

    if ($verif==false) { //si faux c'est que les variables $date_arrivee et $date_depart sont données en strtotime

        $date_arrivee_sql = date("Y-m-d",$date_arrivee);
        $date_depart_sql = date("Y-m-d",$date_depart);
    }
    else {//si vrai on transforme au format yyyy-mm-dd puis on récupère aussi le format strtotime

        $date_arrivee_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_arrivee);
        $date_depart_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_depart);
        $date_arrivee=strtotime($date_arrivee_sql);
        $date_depart=strtotime($date_depart_sql);
    }

    $num_reservation=0; //à 0 car non nécessaire pour la suite
    $content='';

    include("bdd_connect.php");

    for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++) {


        include("logements_presentation.php");

        $table='reservation_'.$lieu;

// compte le nombre d'avis par logements pour l'insérer dans la présentation des logements

        $compte_avis= $bdd->query('SELECT COUNT(commentaire) AS nombre_avis FROM '.$table.' WHERE commentaire IS NOT NULL');
        $nombre_avis= $compte_avis->fetch();
        $_SESSION['nombre_avis_'.$lieu]=$nombre_avis['nombre_avis'];
// fait la oyenne des notes pour l'insérer dans  la présentation des logements dans le popup commentaires
        $cherche_moyenne_etoile= $bdd->query('SELECT ROUND(AVG(etoile),1) AS moyenne_etoile FROM '.$table.' WHERE etoile IS NOT NULL');
        $moyenne_etoile=$cherche_moyenne_etoile->fetch();
        $_SESSION['moyenne_etoile_'.$lieu]=$moyenne_etoile['moyenne_etoile'];


//charge les images qui seront présentes sous le popup
        $image="images/".$lieu."/".$lieu."1.jpg"; //charge l'image de présentation puis la visionneuse organisée via magnific-popup au travers de la class gallery
        ${'content'.$logement}='<div class="element">
                                  <div class="gallery container"> 
                                    <a href="'.$image.'"><img src="'.$image.'" class="image_presentation"></a>';

        $i=2;
        while (file_exists("images/".$lieu."/".$lieu.$i.".jpg"))
        {
            $image="images/".$lieu."/".$lieu.$i.".jpg";
            ${'content'.$logement}.='<a href="'.$image.'" style="display: none;"></a>';
            $i++;
        }

        //chargement des caractéristiques disponibilités et prix par logement
        ${'prix_'.$lieu}=prix_logement($date_arrivee_sql,$date_depart_sql,$nbre_personne,$logement);
        ${'dispo_'.$lieu}=dispo_logement($date_arrivee_sql,$date_depart_sql,$num_reservation,$logement);
        $lieu_MAJ=strtoupper($lieu);

        //calcul du nombre de nuits
        $date_arrivee_duree = new datetime($date_arrivee_sql);
        $date_depart_duree = new datetime($date_depart_sql);
        $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
        $nombre_nuit=$nbre_nuit_reservation->format('%a');


        if ($nbre_personne>$max_nbre_personne)
        {
            ${'content'.$logement} .='</div><div style="text-align: left;color:rgb(57,141,157);font-size: 14px;font-weight: bold;margin-left: 5px;">Désolé maximum '. $max_nbre_personne.' personnes pour ce logement.</div>';
        }
        else if (${'dispo_'.$lieu}==true && $nbre_personne<=$max_nbre_personne)
        {
            ${'content'.$logement} .='</div><div class="affichage_prix" ><img src="icones/yes_dispo.jpg" width="20px" height="20px"> '.${'prix_'.$lieu}.' euros TTC :<span style="font-weight: normal;"> '.$nombre_nuit.' nuit(s) / '.$nbre_personne.' personne(s)</span></div>';
        }

        else if (${'dispo_'.$lieu}==false && $nbre_personne<=$max_nbre_personne)
        {
            ${'content'.$logement} .='</div><div class="affichage_prix" style="font-size: 16px;"><img src="icones/no_dispo.jpg" width="20px" height="20px">  Non disponible pour vos dates</div>';
        }

        ${'content'.$logement} .='<div style="margin-top:5px;text-align: center;color:#FF6959;font-size: 24px;font-weight: bold;">Chez '.$lieuMAJ.' !</div>
                                      <a class="ouvre_googlemaps" href="'.$adresse_google.'" style="font-size: 0.7em;font-style: normal;color:black;text-align: center;"><img src="icones/google-maps2.png" style="width:20px;height:20px;">'.$adresse_logement.' </a>
                      
                                      <div class="description_bien" >
                                      
                                              Quartier : <b>'.$localisation.'</b></br>
                                              Surface : <b>'.$surface.'</b></br>
                                              Type : <b>'.$type_logement.'</b></br>
                                              Nombre de Chambre : <b>'.$nbre_chambre.'</b> </br> 
                                              Capacité : <b>'.$capacite.'</b> </br>
                                          
                                              <span>
                                                  <a onclick="xajax_afficher_avis('.$logement.');" style="cursor:pointer;"><img src="icones/etoile_avis.jpg" title="Avis" alt="Avis" class="icone_avis" style="width:40px;height:10px;"/><span class="texte_avis">Avis ('.$_SESSION['nombre_avis_'.$lieu].')</span></a>
                                              </span>

                                              <span> 
                                                  <a onclick="xajax_afficher_calendrier('.$logement.');" style="cursor:pointer;"><img src="icones/calendrier2.png" alt="calendrier" class="icone_calendrier"/><span class="texte_calendrier"> Calendrier</span></a>
                                              </span>   
                                              <span>
                                                     <a style="color:black; margin-left:25px;font-variant: small-caps;font-size: 1.2em;font-weight: bold;"><span>+ d\'infos... </span></a>
                                              </span>

                                        </div>

                                        <div style="text-align: center;display:flex;justify-content:space-between;">
                                            <div class="element_button">';

        if (isset($_SESSION['id']))

        {${'content'.$logement} .='<button type="submit" class="button_logement" style="cursor:pointer;opacity: 1;font-weight:normal; color:#3E849E;" onclick="xajax_editer_devis('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.${'prix_'.$lieu}.','.$nombre_nuit.','.$logement.');" ><span>Editer devis  </span> </button>';}
        else
        {${'content'.$logement} .='<button type="submit" class="button_logement" style="cursor:pointer;opacity: 1;font-weight:normal; color:#3E849E;" onclick="xajax_preparer_devis('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.${'prix_'.$lieu}.','.$nombre_nuit.','.$logement.');" ><span>Editer devis  </span> </button>';}

        ${'content'.$logement} .='</div>
                                             <div class="element_button">
                                                  <button type="submit" class="button_logement" style="cursor:pointer;opacity: 1;font-weight:normal;" onclick="xajax_reserver('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$logement.');" ><span>Réserver  </span> </button>
                                            </div>

                                        </div>

                                    </div>
                             </div>';

    }


    $panneau_accueil=' <div class="element" style="border:none;box-shadow: 0px 0px 0px #e9f5e1; background-color: #e9f5e1;" >
                                <a href="https://www.google.com/maps/d/viewer?mid=1fuQA-DXZ6qUUcK_7pZ_eo0lu94M&ll=47.97952896177219%2C0.21070850000000974&z=14" data-mfp-src="#popup_calendrier" class="open-popup-link" style="font-style:normal;margin-left:15px;color:gray;font-weight:bold;margin-top:0px;margin-bottom:5px;background-color: #e9f5e1;" >Nos implantations...<div style="margin-top:10px;text-align:center;background-color: #e9f5e1;color:gray;dont-weight:bold;"><img src="images/implantation.png" width="190px" height="104px"/></div></a>
                                
                                <div style="margin-left:15px;color:gray;font-weight:bold;margin-top:20px;margin-bottom:5px;background-color: #e9f5e1;" >Vos équipements...</div>
                                <div style="margin-left:50px;background-color: #e9f5e1;">
                                          <a class="info_bulle"><img src="icones/wifi.png" alt="wifi" class="taille_icone" /><span>Wi-Fi gratuit</span> </a><span style="color:gray;">Wi-Fi gratuit</span></br>
                                          <a class="info_bulle"><img src="icones/television.png" alt="television" class="taille_icone" /><span>TV 16/9 - 82cm</span> </a><span style="color:gray;">TV 16/9 - 82cm</span>  </br>
                                          <a class="info_bulle"><img src="icones/serviettes.png" alt="serviettes" class="taille_icone" /><span>Serviettes et draps fournis</span></a><span style="color:gray;">Serviettes et draps fournis</span> </br> 
                                         <a class="info_bulle"><img src="icones/cuisine.png" alt="cuisine" class="taille_icone"/><span>Cuisine aménagée/équipée</span></a><span style="color:gray;">Cuisine aménagée/équipée</span> </br> 
                                          <a class="info_bulle"><img src="icones/lave-linge.png" alt="lave-linge" class="taille_icone"/><span>Lave-linge/Sèche-linge</span></a><span style="color:gray;">Lave-linge/Sèche-linge</span></br>  
                                          <a class="info_bulle"><img src="icones/lit.png" alt="lit" class="taille_icone"/><span>Lit 180x200</span></a><span style="color:gray;">Lit 180x200</span></br>
                                          <a class="info_bulle"><img src="icones/bebe.png" alt="lit" class="taille_icone"/><span>Equipements bébé disponibles</span></a><span style="color:gray;">Equipements bébé disponibles</span>
                                          </br>   
                                      </div>
                                </div>

                                </section> ';

// première "routine" qui va classer en premier les logements disponibles

    $position=1;

    for ($logement=1;$logement<=$_SESSION['nombre_de_logement'];$logement++)
    {
        include("logements_presentation.php");
        if (${'dispo_'.$lieu}==true && $nbre_personne<=$max_nbre_personne)
        {
            $i=($position-1)%3;
            if ($i==0)
            {
                $content.='<section class="section_logement" >';
            }


            $content.=${'content'.$logement};



            $i=$position%3;
            if ($i==0 && $position>3)
            {

                $content.='
                                     <div class="element" style="border:none;box-shadow: 0px 0px 0px #e9f5e1;background-color: #e9f5e1;">
                                     <div style="padding-top: 25px;"><img src="images/logo2.svg" width="100px" height="100px"/></div>
                                     </div>
                                     </section> 
                                      <div style="display: flex;justify-content: space-around;margin-bottom: 10px;font-size: 20px;">
                                       </div>';
            }

            else if ($i==0 && $position=3)
            {
                $content.=$panneau_accueil;
            }
            $position++;
        }
    }

//puis les logements indisponibles...

    for ($logement=1;$logement<=$_SESSION['nombre_de_logement'];$logement++)
    {
        include("logements_presentation.php");
        if (${'dispo_'.$lieu}==false || $nbre_personne>$max_nbre_personne)
        {
            $i=($position-1)%3;
            if ($i==0)
            {
                $content.='<section class="section_logement" >';
            }

            $content.=${'content'.$logement};



            $i=$position%3;
            if ($i==0 && $position>3)
            {

                $content.='
                                     <div class="element" style="border:none;box-shadow: 0px 0px 0px #e9f5e1;background-color: #e9f5e1;">
                                     <div style="padding-top: 25px;"></div>
                                     </div>
                                     </section> 
                                      <div style="display: flex;justify-content: space-around;margin-bottom: 10px;font-size: 20px;">
                                       </div>';
            }

            else if ($i==0 && $position=3)
            {
                $content.=$panneau_accueil;
            }

            $position++;
        }
    }


    while (($position-1)%3 !=0)
    {
        $content.='<div class="element" style="border:none;box-shadow: 0px 0px 0px #e9f5e1;background-color: #e9f5e1;"></div>';
        $position++;
    }

    $content.='
                        <div class="element" style="border:none;box-shadow: 0px 0px 0px #e9f5e1;background-color: #e9f5e1;">
                          <div id="implantation" style="padding-top: 25px;" onload="loadPage();"></div>
                          </div>
                          </section> 
                           </br><div style="display: flex;justify-content: space-around;margin-bottom: 10px;font-size: 20px;">
                           
                            </div>';

//affiche l'ensemble de la page...


    $reponse->assign('affichage','innerHTML',$content);



    $reponse->script("$('.ouvre_googlemaps').magnificPopup({
        type: 'iframe',

        iframe: {
          markup: '<div class=\"mfp-iframe-scaler\">'+
            '<div class=\"mfp-close\"></div>'+
            '<iframe class=\"mfp-iframe\" frameborder=\"0\" allowfullscreen></iframe>'+
          '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button*/

            patterns: {gmaps: {index: '//maps.google.', src: '%id%&output=embed'}}

            },

        srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. \"iframe_src\" means: find \"iframe\" and set attribute \"src\".
  
      });

    $('.gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
            }
        });
    });

    $('.image-popup-fit-width').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      image: {
        verticalFit: false
      }
    });  


    function loadPage(){
 $.ajax({
   url: \"https://drive.google.com/open?id=1fuQA-DXZ6qUUcK_7pZ_eo0lu94M&usp=sharing\",
   success: function(html){
     $(\"#implantation\").innerHTML = html;
   }
 });
}

  $('.open-popup-link').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });




    ");


    return $reponse;
}

function connect_first()
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.

    $reponse->script("$.magnificPopup.open({
        items: {
        src: '#popup_connexion', 
        type: 'inline'   }
        });");

    return $reponse;
}

function reserver($date_arrivee,$date_depart,$nbre_personne,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.

    if (!isset($_SESSION['id']))
    {
        $reponse->call('xajax_connect_first');
        return $reponse;
    }

    else
    {
        include("logements_presentation.php");

        $verif = preg_match("#/#", $date_arrivee);

        if ($verif==false)
        {

            $date_arrivee_sql = date("Y-m-d",$date_arrivee);
            $date_depart_sql = date("Y-m-d",$date_depart);
            $date_arrivee_fr = date("d/m/Y",$date_arrivee);
            $date_depart_fr = date("d/m/Y",$date_depart);
        }

        else
        {
            $date_arrivee_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_arrivee);
            $date_depart_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_depart);
            $date_arrivee_fr = $date_arrivee;
            $date_depart_fr = $date_depart;
            $date_arrivee=strtotime($date_arrivee_sql);
            $date_depart=strtotime($date_depart_sql);

        }
        $date_arrivee_duree = new datetime($date_arrivee_sql);
        $date_depart_duree = new datetime($date_depart_sql);
        $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
        $nombre_nuit=$nbre_nuit_reservation->format('%a');

        $aujourdhui=date('Y-m-d');
        $verif_jour=strtotime($date_arrivee_sql) - strtotime($aujourdhui);

        if ($nombre_nuit==0 || $verif_jour<0)
        {
            $date_arrivee_fr = '';
            $date_depart_fr = '';
        }
        else
        {
            $num_reservation=0;

            $prix=prix_logement($date_arrivee_sql,$date_depart_sql,$nbre_personne,$logement);
            $dispo=dispo_logement($date_arrivee_sql,$date_depart_sql,$num_reservation,$logement);
        }


        $lieu=strtoupper($lieu);

        $content_base='<div style="text-align: center;color:#ff6959;font-size: 1.5em;">RESERVATION <u>Chez '.$lieu.'</u></div><div>Insérez les données de votre réservation et cliquez sur "Vérifer" pour connaître les possiblités qui s\'offrent à vous ! </div>   

                ';

        if ($date_arrivee_fr=='' && $date_depart_fr=='')
        {
            $content_nouveau=$content_base;
        }

        else
        {

            if ($dispo==true)
            {

                $content_nouveau=$content_base.'</br>___________________</br>
                            <form action="" ></br>
                                <div><b>'.$lieu.' </b> est <span style="color:green;font-weight:bold;">DISPONIBLE</span> aux dates souhaitées </br></br>Arrivée <u><b>'.$date_arrivee_fr.' </b></u> Départ <u><b>'.$date_depart_fr.' </b></u>  </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Prix à régler : <b>'.$prix.'</b> euros TTC</br></br></div>

                                  <label for"commentaire_arrivee" style="padding-top:10px;">Laissez-nous un petit mot sur votre arrivée</label><textarea name="commentaire_arrivee" id="commentaire_arrivee" rows="5" cols="35"></textarea> </br></br>

                                  <input type="submit" value="Confirmer la réservation" style="cursor:pointer;opacity: 1;" onclick="xajax_enregistrer_reservation('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$prix.','.$nombre_nuit.','.$logement.',document.getElementById(\'commentaire_arrivee\').value);return false"/>
                                
                                    <input type="submit" value="modifier ma demande" onclick="xajax_afficher_calendrier('.$logement.');return false;" style="cursor:pointer;opacity: 1;" />
                                         
                              </form>';
            }
            else
            {
                $content_nouveau=$content_base.'</br>___________________</br>
                      
                      <div style="margin-top:15px;"><form action="" >Malheureusement <b>'.$lieu.' </b><span style="color:red;">N\'EST PAS DISPONIBLE</span></br>Du <b>'.$date_arrivee_fr.'</b> au <b>'.$date_depart_fr.'</b>  pour <b>'.$nbre_personne.' </b> personne(s).</br> </div>

                        <div></br>Consultez le calendrier des disponibilités <span> 
                            <a onclick="xajax_afficher_calendrier('.$logement.');" style="cursor:pointer;"><img src="icones/calendrier2.png" alt="calendrier" width="20px" height="20px" style="padding-left:10px;" /></a></span>
                        </div> ';
            }
        }


        $reponse->assign('popup','innerHTML',$content_nouveau);
        $reponse->script("
                
                $.magnificPopup.open({
                items: {
                src: '#popup', 
                type: 'inline'   }
                });

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
                                        var dateFormat = \"dd/mm/yy\",
                                          from = $( \".from\" )
                                            .datepicker({
                                              defaultDate: \"+1w\",
                                              changeMonth: false,
                                              numberOfMonths: 1
                                            })
                                            .on( \"change\", function() {
                                              to.datepicker( \"option\", \"minDate\", getDate( this ) );
                                            }),
                                          to = $( \".to\" ).datepicker({
                                            defaultDate: \"+1w\",
                                            changeMonth: false,
                                            numberOfMonths: 1
                                          })
                                          // .on( \"change\", function() {
                                          //   from.datepicker( \"option\", \"maxDate\", getDate( this ) );
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

                ");

    }
    return $reponse;
}

function enregistrer_reservation($date_arrivee,$date_depart,$nbre_personne,$prixTOTAL,$nombre_nuit,$logement,$commentaire_arrivee)

{
    $reponse = new xajaxResponse();

    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    $date_arrivee_sql = date("Y-m-d",$date_arrivee);
    $date_depart_sql = date("Y-m-d",$date_depart);
    $date_arrivee = date("d/m/Y",$date_arrivee);
    $date_depart = date("d/m/Y",$date_depart);

    $taxe_de_sejour=$nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour'];


    include("bdd_connect.php");

    $req = $bdd->prepare('INSERT INTO '.$table.'(date_arrivee, date_depart, nombre_personne, nombre_nuit, prix, taxe_de_sejour, prenom, nom, telephone, email, id_membre,commentaire_arrivee, date_reservation) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, Current_date)');
    $req->execute(array($date_arrivee_sql, $date_depart_sql, $nbre_personne, $nombre_nuit, $prixTOTAL,$taxe_de_sejour, $_SESSION['prenom'], $_SESSION['nom'], $_SESSION['telephone'], $_SESSION['email'], $_SESSION['id'],$commentaire_arrivee));


    $req2 = $bdd->prepare('SELECT num_reservation FROM '.$table.' WHERE date_arrivee=? AND date_depart=?');
    $req2->execute(array($date_arrivee_sql, $date_depart_sql));
    $num_resa=$req2->fetch();

    $num_reservation=$num_resa['num_reservation'];
    $aujourdhui=date('ymd');
    $numero_piece=$logement.'-'.$aujourdhui.'-'.$_SESSION['id'].'-'.$num_reservation;
    $type_piece='Facture n° ';

    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $adresse=$_SESSION['adresse'];
    $code_postal=$_SESSION['code_postal'];
    $ville=$_SESSION['ville'];
    $telephone=$_SESSION['telephone'];

    $dossier_client='Clients/'.$nom.' '.$prenom.'-'.$_SESSION['id'];

    $nombre_menage=1;
    if($nombre_nuit>=$_SESSION['nombre_jour_menage']){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}
    $forfait_menageTTC=$nombre_menage*$_SESSION['forfait_menageTTC'];

    $numero_piece_origine=null;

    include("prepare_piece.php");
    // télécharge le fichier
    $pdf->Output('Factures/Facture CNCCV '.$numero_piece.'.pdf', 'F');
    $pdf->Output($dossier_client.'/Facture CNCCV '.$numero_piece.'.pdf', 'F');
    $doc = $pdf->Output('S');


    require 'PHPmailer/PHPMailerAutoload.php';

    //Une fois la classe implémentée il faut en créer une nouvelle instance :

    $mail = new PHPmailer();

    //On peut alors paramétrer les différentes propriétés de la classe :

    // Paramètres SMTP
    $mail->IsSMTP(); // activation des fonctions SMTP
    $mail->SMTPAuth = true; // on l’informe que ce SMTP nécessite une autentification
    $mail->SMTPSecure = 'ssl'; // protocole utilisé pour sécuriser les mails 'ssl' ou 'tls'
    $mail->Host = "ssl0.ovh.net"; // définition de l’adresse du serveur SMTP : 25 en local, 465 pour ssl et 587 pour tls
    $mail->Port = 465; // définition du port du serveur SMTP
    $mail->Username = "reservation@cnccv.fr"; // le nom d’utilisateur SMTP
    $mail->Password = "cnccvpass"; // son mot de passe SMTP

    // Paramètres du mail
    $mail->AddAddress("reservation@cnccv.fr",$_SESSION['prenom']); // ajout du destinataire
    $mail->From = "reservation@cnccv.fr"; // adresse mail de l’expéditeur
    $mail->FromName = "Guillaume"; // nom de l’expéditeur
    $mail->AddReplyTo("reservation@cnccv.fr","Guillaume"); // adresse mail et nom du contact de retour
    $mail->IsHTML(true); // envoi du mail au format HTML
    $mail->Subject = "Votre facture CNCCV n° ".$numero_piece; // sujet du mail
    $mail->Body = "<html>Bonjour</html>"; // le corps de texte du mail en HTML
    $mail->AltBody = "Bonjour"; // le corps de texte du mail en texte brut si le HTML n
    $mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');
    if(!$mail->Send()) { // envoi du mail
        echo "Mailer Error: " . $mail->ErrorInfo; // affichage des erreurs, s’il y en a
    }


    $req->closeCursor();
    $req2->closeCursor();

    $reponse->call('xajax_editer_calendrier_Ical_CNCCV');

    $content='<div>Votre devis vous a été envoyé par mail. Vous le trouverez aussi <a href="Factures/Facture CNCCV '.$numero_piece.'.pdf">ici</a> en téléchargement</div>';
    $reponse->assign('popup','innerHTML',$content);
    $reponse->script("$.magnificPopup.open({
          items: {
          src: '#popup', 
          type: 'inline'   }
          });");

    return $reponse;
}


function preparer_devis($date_arrivee,$date_depart,$nbre_personne,$prixTOTAL,$nombre_nuit,$logement)
{

    $reponse = new xajaxResponse();






    return $reponse;
}

function editer_devis($date_arrivee,$date_depart,$nbre_personne,$prixTOTAL,$nombre_nuit,$logement)

{

    $reponse = new xajaxResponse();

    include("logements_presentation.php");


    $date_arrivee = date("d/m/Y",$date_arrivee);
    $date_depart = date("d/m/Y",$date_depart);

    $taxe_de_sejour=$nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour'];

    $aujourdhui=date('ymd');
    $num_reservation=date('His');
    $numero_piece=$logement.'-'.$aujourdhui.'-'.$num_reservation;
    $type_piece='Devis n° ';

    if (isset($_SESSION['id']))
    {
        $prenom=$_SESSION['prenom'];
        $nom=$_SESSION['nom'];
        $adresse=$_SESSION['adresse'];
        $code_postal=$_SESSION['code_postal'];
        $ville=$_SESSION['ville'];
        $telephone=$_SESSION['telephone'];
    }
    else
    {
        $prenom='prenom';
        $nom='nom';
        $adresse='adresse';
        $code_postal='code_postal';
        $ville='ville';
        $telephone='telephone';
    }

    $nombre_menage=1;
    if($nombre_nuit>=$_SESSION['nombre_jour_menage']){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}
    $forfait_menageTTC=$nombre_menage*$_SESSION['forfait_menageTTC'];

    $numero_piece_origine=null;

    include("prepare_piece.php");
    // télécharge le fichier

    $pdf->Output('Devis/Devis CNCCV '.$numero_piece.'.pdf', 'F');
    $doc = $pdf->Output('S');


    require 'PHPmailer/PHPMailerAutoload.php';

//Une fois la classe implémentée il faut en créer une nouvelle instance :

    $mail = new PHPmailer();

    //On peut alors paramétrer les différentes propriétés de la classe :

    // Paramètres SMTP
    $mail->IsSMTP(); // activation des fonctions SMTP
    $mail->SMTPAuth = true; // on l’informe que ce SMTP nécessite une autentification
    $mail->SMTPSecure = 'ssl'; // protocole utilisé pour sécuriser les mails 'ssl' ou 'tls'
    $mail->Host = "ssl0.ovh.net"; // définition de l’adresse du serveur SMTP : 25 en local, 465 pour ssl et 587 pour tls
    $mail->Port = 465; // définition du port du serveur SMTP
    $mail->Username = "reservation@cnccv.fr"; // le nom d’utilisateur SMTP
    $mail->Password = "cnccvpass"; // son mot de passe SMTP

    // Paramètres du mail
    $mail->AddAddress("reservation@cnccv.fr",$_SESSION['prenom']); // ajout du destinataire
    $mail->From = "reservation@cnccv.fr"; // adresse mail de l’expéditeur
    $mail->FromName = "Guillaume"; // nom de l’expéditeur
    $mail->AddReplyTo("reservation@cnccv.fr","Guillaume"); // adresse mail et nom du contact de retour
    $mail->IsHTML(true); // envoi du mail au format HTML
    $mail->Subject = "Votre devis CNCCV"; // sujet du mail
    $mail->Body = "<html>Bonjour</html>"; // le corps de texte du mail en HTML
    $mail->AltBody = "Bonjour"; // le corps de texte du mail en texte brut si le HTML n
    $mail->AddStringAttachment($doc, 'doc.pdf', 'base64', 'application/pdf');
    if(!$mail->Send()) { // envoi du mail
        echo "Mailer Error: " . $mail->ErrorInfo; // affichage des erreurs, s’il y en a
    }

    $content='<div>Votre devis vous a été envoyé par mail. Vous le trouverez aussi <a href="Devis/Devis CNCCV '.$numero_piece.'.pdf">ici</a> en téléchargement</div>';
    $reponse->assign('popup','innerHTML',$content);
    $reponse->script("$.magnificPopup.open({
          items: {
          src: '#popup', 
          type: 'inline'   }
          });");

    return $reponse;

}



function demande_annuler($num_resa_a_annuler,$i,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.


    include("bdd_connect.php");

    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    $req = $bdd->prepare('SELECT * FROM '.$table.' WHERE num_reservation = ?');
    $req->execute(array($num_resa_a_annuler));
    $reservation = $req->fetch();

    $prix=$reservation['prix']+$reservation['supplement']-$reservation['avoir'];

    $date_arrivee_annuler=$reservation['date_arrivee'];
    $aujourdhui=date('Y-m-d');
    $today = new datetime($aujourdhui);
    $date_arrivee = new datetime($date_arrivee_annuler);
    $nb_jour_avant_arrivee = $date_arrivee->diff($today);
    $nombre_jour_avant_arrivee=$nb_jour_avant_arrivee->format('%a');

    if ($nombre_jour_avant_arrivee >=$_SESSION['nombre_jour_cancel_possible'])
    {
        $content='<div style="text-align: center;color:#ff6959;font-size: 1.5em;">ANNULATION</div><div> En confirmant votre annulation, vous serez recrédité de la somme de <b>'.$prix.'</b> euros dans les meilleurs délais</div>
                          <p style="text-align:center;"><input type="submit" value="Confirmer votre annulation" onclick="xajax_confirme_annuler('.$prix.','.$num_resa_a_annuler.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></p>';

    }
    else if ($nombre_jour_avant_arrivee <=$_SESSION['nombre_jour_no_cancel'])
    {
        $content='<div style="text-align: center;color:#ff6959;font-size: 1.5em;">ANNULATION</div><div> Navré, conformément à nos conditions générales, il n\'est pas possible d\'annuler le jour de votre arrivée</div>';
    }

    else
    {
        $avoir= (1-$_SESSION['penalite_annulation_modification_tardive'])*$prix;
        $content='<div style="text-align: center;color:#ff6959;font-size: 1.5em;">ANNULATION</div> <div> En confirmant votre annulation, conformément à nos conditions générales, vous serez recrédité de la somme de <b>'.$avoir.'</b> euros dans les meilleurs délais</div>
                          <p style="text-align:center;"><input type="submit" value="Confirmer votre annulation" onclick="xajax_confirme_annuler('.$avoir.','.$num_resa_a_annuler.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></p>';
    }

    $reponse->assign('popup','innerHTML',$content);
    $reponse->script("$.magnificPopup.open({
        items: {
        src: '#popup', 
        type: 'inline'   }
        });");

    return $reponse;
}

function confirme_annuler($avoir,$num_reservation,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.
    include("bdd_connect.php");

    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    $req = $bdd->prepare('SELECT * FROM '.$table.' WHERE num_reservation=?');
    $req->execute(array($num_reservation));
    $resultat=$req->fetch();

    $date_arrivee_duree = new datetime($resultat['date_arrivee']);
    $date_depart_duree = new datetime($resultat['date_depart']);
    $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
    $nombre_nuit=$nbre_nuit_reservation->format('%a');
    $nbre_personne=$resultat['nombre_personne'];
    $taxe_de_sejour=$nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour'];

    $date= new datetime($resultat['date_reservation']);
    $date_reservation=$date->format('ymd');
    $aujourdhui=date('ymdhis');
    $numero_piece=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation.'-'.$aujourdhui;
    $numero_piece_origine=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation;
    $type_piece='Avoir n° ';

    $req2 = $bdd->prepare('UPDATE '.$table.' SET annule_le = current_date, avoir = ? WHERE num_reservation = ?');
    $req2->execute(array($avoir, $num_reservation));


    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $adresse=$_SESSION['adresse'];
    $code_postal=$_SESSION['code_postal'];
    $ville=$_SESSION['ville'];
    $telephone=$_SESSION['telephone'];

    $dossier_client='Clients/'.$nom.' '.$prenom.'-'.$_SESSION['id'];


    $date_arrivee= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$resultat['date_arrivee']);
    $date_depart= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$resultat['date_depart']);
    $prixTOTAL=$avoir;

    $nombre_menage=1;
    if($nombre_nuit>=8){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}
    $forfait_menageTTC=$nombre_menage*$_SESSION['forfait_menageTTC'];

    include("prepare_piece.php");
    // télécharge le fichier
    $pdf->Output('Avoirs/Avoir CNCCV '.$numero_piece.'.pdf', 'F');
    $pdf->Output($dossier_client.'/Avoir CNCCV '.$numero_piece.'.pdf', 'F');



// RESTE A AJOUTER LA FONCTION ENVOI DE MAIL

    $reponse->call('xajax_editer_calendrier_Ical_CNCCV');
    $req->closeCursor();
    $req2->closeCursor();
    $reponse->script("location.reload(true);");

    return $reponse;
}

function demande_modifier($date_arrivee,$date_depart,$nbre_personne,$i,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.

    include("logements_presentation.php");

    $verif = preg_match("#/#", $date_arrivee);

    if ($verif==false)
    {
        $date_arrivee_sql = date("Y-m-d",$date_arrivee);
        $date_depart_sql = date("Y-m-d",$date_depart);
        $date_arrivee_fr = date("d/m/Y",$date_arrivee);
        $date_depart_fr = date("d/m/Y",$date_depart);

    }
    else
    {
        $date_arrivee_fr = $date_arrivee;
        $date_depart_fr = $date_depart;
        $date_arrivee_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_arrivee);
        $date_depart_sql = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$date_depart);
    }

    $date_arrivee =strtotime($date_arrivee_sql);
    $date_depart = strtotime($date_depart_sql);

    $date_arrivee_init_comp= strtotime($_SESSION['resa_'.$lieu.$i][0]);
    $date_depart_init_comp= strtotime($_SESSION['resa_'.$lieu.$i][1]);
    $diff_arrivee=$date_arrivee-$date_arrivee_init_comp;
    $diff_depart=$date_depart-$date_depart_init_comp;

    $date_from = new datetime($date_arrivee_sql);
    $date_to = new datetime($date_depart_sql);
    $nb_nuit_nouveau = $date_to->diff($date_from);
    $nombre_nuit=$nb_nuit_nouveau->format('%a');

    $nbre_nuit_initial = $_SESSION['resa_'.$lieu.$i][4];
    $diff_nombre_nuit=$nombre_nuit-$nbre_nuit_initial;

    $aujourdhui=date('Y-m-d');
    $verif_jour=$date_arrivee - strtotime($aujourdhui);

    $num_reservation= $_SESSION['resa_'.$lieu.$i][3];
    $prix_nouveau=prix_logement($date_arrivee_sql,$date_depart_sql,$nbre_personne,$logement);
    $dispo_nouveau=dispo_logement($date_arrivee_sql,$date_depart_sql,$num_reservation,$logement);

    $date_arrivee_initial= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['resa_'.$lieu.$i][0]);
    $date_depart_initial= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$_SESSION['resa_'.$lieu.$i][1]);
    $prix_initial = $_SESSION['resa_'.$lieu.$i][5];
    $nbre_personne_initial = $_SESSION['resa_'.$lieu.$i][2];



    $lieu_MAJ=strtoupper($lieu);
    $content_base='<div style="text-align: center;color:#ff6959;font-size: 1.5em;">MODIFICATION de réservation</br><u><b>CHEZ '.$lieu_MAJ.'</u></b></div><div></br>Modifier les données de votre réservation et cliquez sur "Vérifier" pour connaître les possiblités qui s offrent à vous ! </div>
                          
                          <form action="">
                                                       
                                <div class="style_champ_dispo_mod">
                                    <label for="from_mod" class="white">Du </label>     
                                    <input type="text" id="from_mod" name="from_mod" value="'.$date_arrivee_initial.'" class="from champ_dispo_mod" />
                                
                                    <label for="to_mod" class="white" ">Au </label>
                                    <input type="text" id="to_mod" name="to_mod" value="'.$date_depart_initial.'" class="to champ_dispo_mod"/>
                                 </div>
                                 <div class="style_champ_dispo_mod"> 
                                  <label for="nbre_personne" class="white" >Voyageurs</label>
                                    <input type="number" id="nbre_personne" name="nbre_personne" class="champ_dispo_mod" min="1" max="'.$max_nbre_personne.'" step="1" value="'.$nbre_personne_initial.'" />
                                  </div>
                              
                              <p>Prix déjà payé = <b>'.$prix_initial.'</b> euros.</p>
                                                         
                            <input type="submit" value="Vérifier" id="disponibilites" onclick="xajax_demande_modifier(document.getElementById(\'from_mod\').value, document.getElementById(\'to_mod\').value,document.getElementById(\'nbre_personne\').value,'.$i.','.$logement.');return false;" style="text-align:center;cursor:pointer;opacity: 1;"/>
                          </form>';

    if (($diff_arrivee==0 && $diff_depart==0 && $nbre_personne_initial==$nbre_personne) || $nombre_nuit<=0 || $verif_jour<0 )
    {
        $content_nouveau=$content_base;
    }

    else
    {
        if ($dispo_nouveau==true)
        {

            $aujourdhui=date('Y-m-d');
            $today = new datetime($aujourdhui);
            $date = new datetime($date_arrivee_sql);
            $nb_jour_avant_arrivee = $date->diff($today);
            $nombre_jour_avant_arrivee=$nb_jour_avant_arrivee->format('%a');

            if ($nombre_jour_avant_arrivee >=$_SESSION['nombre_jour_cancel_possible'])
            {
                if ($prix_nouveau>($prix_initial+$_SESSION['minimum_de_facturation']))
                {
                    $supplement = $prix_nouveau-$prix_initial;

                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Supplément à régler de <b>'.$supplement.'</b> euros.</br></br></div>
                          <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }

                else if ($prix_nouveau<=($prix_initial+$_SESSION['minimum_de_facturation']) && $diff_nombre_nuit>0)
                {
                    $supplement=0;
                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Cette modification vous est offerte !!! Cliquez ci-dessous pour valider... </br></br></div>
                            <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
                else
                {
                    $avoir=$prix_initial-$prix_nouveau;
                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>Vous souhaitez modifier votre réservation </br></br>Arrivée <b>'.$date_arrivee_fr.'</b> Départ <b>'.$date_depart_fr.'</b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br>Vous disposez d\'un avoir de <b>'.$avoir.'</b> euros qui vous sera restitué sous 8 jours maximum par recrédit sur votre carte bancaire</br></br></div>
                            <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_avoir('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$avoir.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
            }
            else if ($nombre_jour_avant_arrivee <=$_SESSION['nombre_jour_no_cancel'])
            {
                if ($prix_nouveau>($prix_initial+$_SESSION['minimum_de_facturation']))
                {
                    $supplement = $prix_nouveau-$prix_initial;

                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Supplément à régler de <b>'.$supplement.'</b> euros</br></br></div>
                          <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
                else if ($prix_nouveau<=($prix_initial+$_SESSION['minimum_de_facturation']) && $diff_nombre_nuit>0)
                {
                    $supplement=0;
                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Cette modification vous est offerte par toute l\'équipe CNCCV ! Cliquez ci-dessous pour valider... </br></br></div>
                            <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
                else
                {
                    $content_nouveau=$content_base.'</br>___________________</br><p><div><form action="" >Malheureusement, suivant nos conditions générales, la modification souhaitée </br> Du <b>'.$date_arrivee_fr.'</b> au <b>'.$date_depart_fr.'</b> pour<b> '.$nbre_personne.'</b> personne(s) ne peut aboutir.</br><b>';
                }
            }
            else
            {
                if ($prix_nouveau>($prix_initial+$_SESSION['minimum_de_facturation']))
                {
                    $supplement = $prix_nouveau-$prix_initial;

                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Supplément à régler de <b>'.$supplement.'</b> euros</br></br></div>
                          <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
                else if ($prix_nouveau<=($prix_initial+$_SESSION['minimum_de_facturation']) && $diff_nombre_nuit>0)
                {
                    $supplement=0;
                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>La modification souhaitée est possible </br></br>Arrivée <b>'.$date_arrivee_fr.' </b> Départ <b>'.$date_depart_fr.' </b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br> Cette modification vous est offerte par toute l\'équipe CNCCV ! Cliquez ci-dessous pour valider... </br></br></div>
                            <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_supplement('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$supplement.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
                else
                {
                    $avoir=(1-$_SESSION['penalite_annulation_modification_tardive'])*($prix_initial-$prix_nouveau);
                    $content_nouveau=$content_base.'</br>___________________</br><form></br><div>Vous souhaitez modifier votre réservation </br></br>Arrivée <b>'.$date_arrivee_fr.'</b> Départ <b>'.$date_depart_fr.'</b> </br>Pour <b>'.$nbre_personne.' </b> personne(s).</br></br>Vous disposez d\'un avoir de '.$avoir.' euros qui vous sera restitué sous 8 jours maximum par recrédit sur votre carte bancaire</br></br></div>
                            <input type="submit" value="Confirmer cette modification" id="disponibilites" onclick="xajax_confirme_modifier_avoir('.$date_arrivee.','.$date_depart.','.$nbre_personne.','.$avoir.','.$num_reservation.','.$logement.');return false;" style="cursor:pointer;opacity: 1;"/></form>';
                }
            }
        }
        else
        {
            $content_nouveau=$content_base.'</br>___________________</br><p><div><form action="" >Malheureusement la modification souhaitée </br> Du <b>'.$date_arrivee_fr.'</b> au <b>'.$date_depart_fr.'</b> pour<b> '.$nbre_personne.'</b> personne(s) ne peut aboutir.</br><b> Testez les disponibilités sur nos 
                            <input type="date" id="from" value="'.$date_arrivee.'" hidden />
                            <input type="date" id="to" value="'.$date_depart.'" hidden />
                            <input type="tel" id="nombre_personne" value="'.$nbre_personne.'" hidden />
                            
                            <input type="submit" value="autres logements" style="color:white; background-color:#ff6959;font-weight:bolder;cursor:pointer;opacity: 1;" onclick="xajax_afficher_dispo_prix(document.getElementById(\'from\').value,document.getElementById(\'to\').value,document.getElementById(\'nombre_personne\').value);return false;" />
                        </form>  </b></div></p>';

        }
    }


    $reponse->assign('popup','innerHTML',$content_nouveau);
    $reponse->script("
        $.magnificPopup.open({
        items: {
        src: '#popup', 
        type: 'inline'   }
        });

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
                                var dateFormat = \"dd/mm/yy\",
                                  from = $( \".from\" )
                                    .datepicker({
                                      defaultDate: \"+1w\",
                                      changeMonth: false,
                                      numberOfMonths: 1
                                    })
                                    .on( \"change\", function() {
                                      to.datepicker( \"option\", \"minDate\", getDate( this ) );
                                    }),
                                  to = $( \".to\" ).datepicker({
                                    defaultDate: \"+1w\",
                                    changeMonth: false,
                                    numberOfMonths: 1
                                  })
                                  // .on( \"change\", function() {
                                  //   from.datepicker( \"option\", \"maxDate\", getDate( this ) );
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

        ");
    return $reponse;
}


function confirme_modifier_supplement($date_arrivee,$date_depart,$nbre_personne,$supplement,$num_reservation,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.


    include("bdd_connect.php");

    $date_arrivee_sql = date("Y-m-d",$date_arrivee);
    $date_depart_sql = date("Y-m-d",$date_depart);

    $date_arrivee_duree = new datetime($date_arrivee_sql);
    $date_depart_duree = new datetime($date_depart_sql);
    $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
    $nombre_nuit=$nbre_nuit_reservation->format('%a');


    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    $req = $bdd->prepare('SELECT * FROM '.$table.' WHERE num_reservation=?');
    $req->execute(array($num_reservation));
    $resultat=$req->fetch();


    $taxe_de_sejour_definitif=$nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour'];
    $taxe_de_sejour=$taxe_de_sejour_definitif-$resultat['taxe_de_sejour'];

    $supplement_definitif=$supplement+$resultat['supplement'];

    $req2 = $bdd->prepare('UPDATE '.$table.' SET modifie_le = current_date, date_arrivee =?, date_depart=?, nombre_personne=?, nombre_nuit=?, supplement = ?, taxe_de_sejour=? WHERE num_reservation = ?');
    $req2->execute(array($date_arrivee_sql, $date_depart_sql, $nbre_personne, $nombre_nuit,$supplement_definitif,$taxe_de_sejour_definitif, $num_reservation));

    $date= new datetime($resultat['date_reservation']);
    $date_reservation=$date->format('ymd');
    $aujourdhui=date('ymdhis');
    $numero_piece=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation.'-'.$aujourdhui;
    $numero_piece_origine=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation;
    $type_piece='Facture n° ';

    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $adresse=$_SESSION['adresse'];
    $code_postal=$_SESSION['code_postal'];
    $ville=$_SESSION['ville'];
    $telephone=$_SESSION['telephone'];

    $dossier_client='Clients/'.$nom.' '.$prenom.'-'.$_SESSION['id'];

    $date_arrivee= date('d/m/Y',$date_arrivee);
    $date_depart= date('d/m/Y',$date_depart);

    $prixTOTAL=$supplement;

    $nombre_menage_ancien=round($resultat['nombre_nuit']/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);
    if ($nombre_menage_ancien==0){$nombre_menage_ancien=1;}

    $nombre_menage=1;
    if($nombre_nuit>=8){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}
    $forfait_menageTTC=($nombre_menage-$nombre_menage_ancien)*$_SESSION['forfait_menageTTC'];

    include("prepare_piece.php");
    // télécharge le fichier
    $pdf->Output('Factures/Facture CNCCV '.$numero_piece.'.pdf', 'F');
    $pdf->Output($dossier_client.'/Facture CNCCV '.$numero_piece.'.pdf', 'F');



// RESTE A AJOUTER LA FONCTION ENVOI DE MAIL

    $reponse->call('xajax_editer_calendrier_Ical_CNCCV');
    $req->closeCursor();
    $req2->closeCursor();
    $reponse->script("location.reload(true);");

    return $reponse;
}

function confirme_modifier_avoir($date_arrivee,$date_depart,$nbre_personne,$avoir,$num_reservation,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.


    include("bdd_connect.php");

    $date_arrivee_sql = date("Y-m-d",$date_arrivee);
    $date_depart_sql = date("Y-m-d",$date_depart);

    $date_arrivee_duree = new datetime($date_arrivee_sql);
    $date_depart_duree = new datetime($date_depart_sql);
    $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
    $nombre_nuit=$nbre_nuit_reservation->format('%a');


    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    $req = $bdd->prepare('SELECT * FROM '.$table.' WHERE num_reservation=?');
    $req->execute(array($num_reservation));
    $resultat=$req->fetch();


    $taxe_de_sejour_definitif=$nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour'];
    $taxe_de_sejour=$taxe_de_sejour_definitif-$resultat['taxe_de_sejour'];

    $avoir_definitif=$avoir+$resultat['avoir'];

    $req2 = $bdd->prepare('UPDATE '.$table.' SET modifie_le = current_date, date_arrivee =?, date_depart=?, nombre_personne=?, nombre_nuit=?, avoir = ?, taxe_de_sejour=? WHERE num_reservation = ?');
    $req2->execute(array($date_arrivee_sql, $date_depart_sql, $nbre_personne, $nombre_nuit,$avoir_definitif,$taxe_de_sejour_definitif, $num_reservation));

    $date= new datetime($resultat['date_reservation']);
    $date_reservation=$date->format('ymd');
    $aujourdhui=date('ymdhis');
    $numero_piece=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation.'-'.$aujourdhui;
    $numero_piece_origine=$logement.'-'.$date_reservation.'-'.$_SESSION['id'].'-'.$num_reservation;
    $type_piece='Avoir n° ';

    $prenom=$_SESSION['prenom'];
    $nom=$_SESSION['nom'];
    $adresse=$_SESSION['adresse'];
    $code_postal=$_SESSION['code_postal'];
    $ville=$_SESSION['ville'];
    $telephone=$_SESSION['telephone'];

    $dossier_client='Clients/'.$nom.' '.$prenom.'-'.$_SESSION['id'];

    $date_arrivee= date('d/m/Y',$date_arrivee);
    $date_depart= date('d/m/Y',$date_depart);

    $prixTOTAL=$avoir;

    $nombre_menage_ancien=round($resultat['nombre_nuit']/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);
    if ($nombre_menage_ancien==0){$nombre_menage_ancien=1;}

    $nombre_menage=1;
    if($nombre_nuit>=8){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}
    $forfait_menageTTC=($nombre_menage-$nombre_menage_ancien)*$_SESSION['forfait_menageTTC'];

    include("prepare_piece.php");
    // télécharge le fichier
    $pdf->Output('Avoirs/Avoir CNCCV '.$numero_piece.'.pdf', 'F');
    $pdf->Output($dossier_client.'/Avoir CNCCV '.$numero_piece.'.pdf', 'F');



// RESTE A AJOUTER LA FONCTION ENVOI DE MAIL

    $reponse->call('xajax_editer_calendrier_Ical_CNCCV');

    $req->closeCursor();
    $req2->closeCursor();
    $reponse->script("location.reload(true);");

    return $reponse;
}

function dispo_logement($date_arrivee,$date_depart,$num_reservation,$logement)
{
    $reponse = new xajaxResponse();

    // include("MAJ_calendrier_Airbnb.php");
    $reponse->call('xajax_MAJ_calendrier_Airbnb');

    include("logements_presentation.php");
    $table='reservation_'.$lieu;


    include("bdd_connect.php");

    $rep = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND ? BETWEEN date_arrivee AND date_sub(date_depart, interval 1 day)');
    $rep->execute(array($date_arrivee));
    $dispo_arrivee=$rep->fetch();
    if (isset($dispo_arrivee['num_reservation'])) {if ($dispo_arrivee['num_reservation']==$num_reservation) { $arrivee=true;} else {$arrivee=false;}} else { $arrivee=true;}

    $rep2 = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND ? BETWEEN date_add(date_arrivee,interval 1 day) AND date_depart');
    $rep2->execute(array($date_depart));
    $dispo_depart=$rep2->fetch();
    if (isset($dispo_depart['num_reservation'])) {if ($dispo_depart['num_reservation']==$num_reservation) { $depart=true;} else {$depart=false;}} else { $depart=true;}

    $rep3 = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND date_add(?,interval 1 day) < date_arrivee AND date_sub(?,interval 1 day) > date_depart');
    $rep3->execute(array($date_arrivee,$date_depart));
    $dispo_periode=$rep3->fetch();
    if (isset($dispo_periode['num_reservation'])) {if ($dispo_periode['num_reservation']==$num_reservation) { $periode=true;} else {$periode=false;}} else { $periode=true;}

    $rep->closeCursor();
    $rep2->closeCursor();
    $rep3->closeCursor();


    if ($arrivee==true && $depart==true && $periode==true)

    {
        $reponse= true;
    }
    else
    {
        $reponse= false;
    }


    return $reponse;
}


function prix_logement($date_arrivee,$date_depart,$nbre_personne,$logement)
{

    $reponse = new xajaxResponse();


    include("logements_presentation.php");

    include("bdd_connect.php");


    $req_prix = $bdd->prepare('SELECT SUM(prix) AS prix_base FROM base_prix WHERE date_reservation BETWEEN :date_arrivee AND date_sub(:date_depart,interval 1 day)');
    $req_prix->execute(array(
        'date_arrivee' => $date_arrivee,
        'date_depart' => $date_depart));
    $base_prix=$req_prix->fetch();

    $prix_base= intval($base_prix['prix_base']);

    $prix_base = $coef_prix*$prix_base;

    $req_prix->closeCursor();

    $date_arrivee_duree = new datetime($date_arrivee);
    $date_depart_duree = new datetime($date_depart);
    $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
    $nombre_nuit=$nbre_nuit_reservation->format('%a');

    $nombre_menage=1;

    if($nombre_nuit>=8){$nombre_menage=round($nombre_nuit/$_SESSION['nombre_jour_menage'],0,PHP_ROUND_HALF_UP);}


    if ($nombre_nuit>=8 && $nombre_nuit<30)
    {
        $prix_base=ceil((1-$_SESSION['remise_semaine'])*$prix_base);
    }
    if ($nombre_nuit>=30)
    {
        $prix_base=ceil((1-$_SESSION['remise_mois'])*$prix_base);
    }

    $taxe_de_sejour=ceil($nbre_personne*$nombre_nuit*$_SESSION['taxe_de_sejour']);


    if ($nbre_personne>2)
    {
        $reponse= ceil((1+(($nbre_personne-2)*$_SESSION['coef_prix_pers_supp']))*$prix_base) + $taxe_de_sejour +($nombre_menage*$_SESSION['forfait_menageTTC']);

    }
    else
    {

        $reponse= $prix_base+$taxe_de_sejour +($nombre_menage*$_SESSION['forfait_menageTTC']);
    }

    return $reponse;
}

function afficher_avis($logement)
{

    $reponse = new xajaxResponse();


    $content_commentaire=NULL;
    include("logements_presentation.php");
    $table="reservation_".$lieu;

    include("bdd_connect.php");


    $recherche_avis= $bdd->query('SELECT * FROM '.$table.' WHERE commentaire IS NOT NULL ORDER BY date_depart DESC');
    while($avis=$recherche_avis->fetch())
    {
        $prenom=$avis['prenom'];
        $date_depart= preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$2/$1',$avis['date_depart']);
        $m = array(1=>'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

        $decoupe_date= explode('/', $date_depart);
        $mois= intval($decoupe_date[0]);
        $mois_commentaire = $m[$mois];
        $annee_commentaire= $decoupe_date[1];


        $content_coordonnee='<p style="font-size: 15px;">'.$prenom.' '.$mois_commentaire.' '.$annee_commentaire.'</br>';


        if ($avis['etoile']==1)
        {
            $content_etoile='<span class="etoile_orange">★</span><span class="etoile_grise">★★★★</span></br>';
        }
        else if ($avis['etoile']==2)
        {

            $content_etoile='<span class="etoile_orange">★★</span><span class="etoile_grise">★★★</span></br>';

        }
        else if ($avis['etoile']==3)
        {
            $content_etoile='<span class="etoile_orange">★★★</span><span class="etoile_grise">★★</span></br>';

        }
        else if ($avis['etoile']==4)
        {
            $content_etoile='<span class="etoile_orange">★★★★</span><span class="etoile_grise">★</span></br>';

        }
        else
        {
            $content_etoile='<span class="etoile_orange">★★★★★</span></br>';

        }

        $content_avis=$avis['commentaire'].'</br> _____________________________ </p>';

        $content_commentaire=$content_commentaire.$content_coordonnee.$content_etoile.$content_avis;

    }
    $recherche_avis->closeCursor();


    $content_base = 'Commentaires :</br>
                    Nombre d\'avis :'.$_SESSION['nombre_avis_'.$lieu].'</br>
                    Note moyenne : '.$_SESSION['moyenne_etoile_'.$lieu].'</br>';

    $content=$content_base.$content_commentaire;

    $reponse->assign('popup','innerHTML',$content);
    $reponse->script("
                     $.magnificPopup.open({
                    items: {
                    src: '#popup', 
                    type: 'inline'   }
                    });");

    return $reponse;

}

function ecrire_commentaire($num_reservation,$logement)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.

    include("logements_presentation.php");
    $lieu_MAJ=strtoupper($lieu);

    $content='<div style="text-align: center;color:#ff6959;font-size: 1.5em;padding-bottom:15px;">COMMENTAIRE SUR <u><b>'.$lieu_MAJ.'</b></u></div>
                          
                    <div class="rating"><span style="padding-right:25px;"><b>Note générale : </b></span><!--
                       --><label tabindex="0" id="note-1" onclick="
                            javascript:document.getElementById(\'notation\').value=1;
                            javascript:document.getElementById(\'note-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-2\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-5\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'valid_commentaire\').disabled=false;
                            javascript:document.getElementById(\'valid_commentaire\').style.opacity=\'1\';
                            javascript:document.getElementById(\'valid_commentaire\').style.cursor=\'pointer\';">★ </label><!--
                       --><label tabindex="0" id="note-2" onclick="
                            javascript:document.getElementById(\'notation\').value=2;
                            javascript:document.getElementById(\'note-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-5\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'valid_commentaire\').disabled=false;
                            javascript:document.getElementById(\'valid_commentaire\').style.opacity=\'1\';
                            javascript:document.getElementById(\'valid_commentaire\').style.cursor=\'pointer\';">★ </label><!--
                       --><label tabindex="0" id="note-3" onclick="
                            javascript:document.getElementById(\'notation\').value=3;
                            javascript:document.getElementById(\'note-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'note-5\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'valid_commentaire\').disabled=false;
                            javascript:document.getElementById(\'valid_commentaire\').style.opacity=\'1\';
                            javascript:document.getElementById(\'valid_commentaire\').style.cursor=\'pointer\';">★ </label><!--
                       --><label tabindex="0" id="note-4" onclick="
                            javascript:document.getElementById(\'notation\').value=4;
                            javascript:document.getElementById(\'note-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-5\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'valid_commentaire\').disabled=false;
                            javascript:document.getElementById(\'valid_commentaire\').style.opacity=\'1\';
                            javascript:document.getElementById(\'valid_commentaire\').style.cursor=\'pointer\';">★ </label><!--
                       --><label tabindex="0" id="note-5" onclick="
                            javascript:document.getElementById(\'notation\').value=5;
                            javascript:document.getElementById(\'note-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'note-5\').style.color=\'orange\';
                            javascript:document.getElementById(\'valid_commentaire\').disabled=false;
                            javascript:document.getElementById(\'valid_commentaire\').style.opacity=\'1\';
                            javascript:document.getElementById(\'valid_commentaire\').style.cursor=\'pointer\';">★ </label>
                    </div></br>
                        <input type="text" id="notation" value="0" hidden />
                    
                    <div class="rating"><span style="padding-right:60px;"><b>Propreté : </b></span><!--
                       --><label tabindex="0" id="proprete-1" onclick="
                            javascript:document.getElementById(\'proprete\').value=1;
                            javascript:document.getElementById(\'proprete-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-2\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="proprete-2" onclick="
                            javascript:document.getElementById(\'proprete\').value=2;
                            javascript:document.getElementById(\'proprete-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="proprete-3" onclick="
                            javascript:document.getElementById(\'proprete\').value=3;
                            javascript:document.getElementById(\'proprete-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'proprete-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="proprete-4" onclick="
                            javascript:document.getElementById(\'proprete\').value=4;
                            javascript:document.getElementById(\'proprete-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="proprete-5" onclick="
                            javascript:document.getElementById(\'proprete\').value=5;
                            javascript:document.getElementById(\'proprete-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'proprete-5\').style.color=\'orange\';">★ </label>
                    </div></br>
                        <input type="text" id="proprete" value="0" hidden />

                    <div class="rating"><span style="padding-right:70px;"><b>Accueil : </b></span><!--
                       --><label tabindex="0" id="accueil-1" onclick="
                            javascript:document.getElementById(\'accueil\').value=1;
                            javascript:document.getElementById(\'accueil-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-2\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="accueil-2" onclick="
                            javascript:document.getElementById(\'accueil\').value=2;
                            javascript:document.getElementById(\'accueil-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="accueil-3" onclick="
                            javascript:document.getElementById(\'accueil\').value=3;
                            javascript:document.getElementById(\'accueil-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'accueil-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="accueil-4" onclick="
                            javascript:document.getElementById(\'accueil\').value=4;
                            javascript:document.getElementById(\'accueil-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="accueil-5" onclick="
                            javascript:document.getElementById(\'accueil\').value=5;
                            javascript:document.getElementById(\'accueil-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'accueil-5\').style.color=\'orange\';">★ </label>
                    </div></br>
                        <input type="text" id="accueil" value="0" hidden />
                    
                    <div class="rating"><span style="padding-right:67px;"><b>Confort : </b></span><!--
                       --><label tabindex="0" id="confort-1" onclick="
                            javascript:document.getElementById(\'confort\').value=1;
                            javascript:document.getElementById(\'confort-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-2\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="confort-2" onclick="
                            javascript:document.getElementById(\'confort\').value=2;
                            javascript:document.getElementById(\'confort-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-3\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="confort-3" onclick="
                            javascript:document.getElementById(\'confort\').value=3;
                            javascript:document.getElementById(\'confort-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-4\').style.color=\'#aaa\';
                            javascript:document.getElementById(\'confort-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="confort-4" onclick="
                            javascript:document.getElementById(\'confort\').value=4;
                            javascript:document.getElementById(\'confort-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-5\').style.color=\'#aaa\';">★ </label><!--
                       --><label tabindex="0" id="confort-5" onclick="
                            javascript:document.getElementById(\'confort\').value=5;
                            javascript:document.getElementById(\'confort-1\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-2\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-3\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-4\').style.color=\'orange\';
                            javascript:document.getElementById(\'confort-5\').style.color=\'orange\';">★ </label>
                    </div></br>
                        <input type="text" id="confort" value="0" hidden />

                    <label for"commentaire" style="padding-top:10px;"><b>Vos commentaires publics </b>: ils seront visibles sur le site.</label><textarea name="commentaire" id="commentaire" rows="5" cols="50"></textarea> </br>
                  
                    <label for"commentaire_prive" style="padding-top:10px;"><b>Vos commentaires privés </b> : confiez-nous ce que nous devons améliorer, ce que vous avez particulièrement apprécié...</label><textarea name="commentaire_prive" id="commentaire_prive" rows="5" cols="50"></textarea> 
                    <p></p>

                    <input type="submit" value="Valider mes commentaires" id="valid_commentaire" onclick="xajax_inserer_commentaire('.$num_reservation.','.$logement.',document.getElementById(\'notation\').value,document.getElementById(\'proprete\').value,document.getElementById(\'accueil\').value,document.getElementById(\'confort\').value,document.getElementById(\'commentaire\').value,document.getElementById(\'commentaire_prive\').value);" style="cursor:default;opacity: 0.6;" disabled="true"/>';


    $reponse->assign('popup','innerHTML',$content);

    $reponse->script("
        $.magnificPopup.open({
            items: {
                  src: '#popup', 
                  type: 'inline'   }
        });");

    return $reponse;
}


function inserer_commentaire($num_reservation,$logement,$note,$proprete,$accueil,$confort,$commentaire,$commentaire_prive)
{
    $reponse = new xajaxResponse();// Création d'une instance de xajaxResponse pour traiter les réponses serveur.

    include("logements_presentation.php");
    $table='reservation_'.$lieu;


    include("bdd_connect.php");

    $req2 = $bdd->prepare('UPDATE '.$table.' SET etoile =?, proprete=?, accueil=?, confort=?, commentaire=?, commentaire_prive=? WHERE num_reservation = ?');
    $req2->execute(array($note,$proprete,$accueil,$confort,$commentaire,$commentaire_prive,$num_reservation));

    $_SESSION['a_commenter_'.$lieu]=false;

    $reponse->script("location.reload(true);");

    return $reponse;
}


function afficher_calendrier($logement)

{
    $reponse = new xajaxResponse();

    $reponse->call('xajax_MAJ_calendrier_Airbnb');

    include("logements_presentation.php");

    $mois_courant=date("m");
    $annee_courante=date("Y");
    $pas=1;

    $lieu_MAJ=strtoupper($lieu);

    $reponse->script('document.getElementById(\'nbre_personne\').value=document.getElementById(\'nombre_personne\').value;');

    $content="<div style=\"margin: 0 auto;font-size:25px;font-weight:bold;color:#ff6959;margin-bottom:20px;\"> Calendrier chez ".$lieu_MAJ."</div><div id=\"patienter\" style=\"color:white;font-size:0px;\">Patientez...</div><div id=\"choose_departure\" style=\"color:white;font-size:0px;\">Choississez une autre date...</div><input type=\"date\" id=\"arrival\" hidden><input type=\"date\" id=\"departure\" hidden><input type=\"tel\" id=\"cliquet\" value=\"0\" hidden/><input type=\"number\" id=\"nbre_personne\" class=\"champ_dispo_mod\" min=\"1\" max=\"".$max_nbre_personne."\" step=\"1\" />";

    while ($pas<13)
    {
        $i=$annee_courante."-".$mois_courant;
        $j=($pas-1)%4;
        if ($j==0)
        {
            $content.="<section style=\"display: flex;justify-content: space-around;width:70%;margin: 0 auto;padding-bottom:10px;\" > ";
        }

        $content.="<div style=\"font-size:12px;\">".showCalendar($i,$logement)."</div>";

        $j=($pas)%4;
        if ($j==0)
        {
            $content.="</section>";
        }

        $mois_courant++;
        if ($mois_courant==13){$mois_courant=1;$annee_courante=$annee_courante+1;}
        $pas++;
    }


    $reponse->assign('popup_calendrier','innerHTML',$content);

    $reponse->script("$.magnificPopup.open({
      items: {
            src: '#popup_calendrier', 
            type: 'inline'   }
  });");

    return $reponse;

}


// Fonction pour afficher le calendrier
function showCalendar($periode,$logement) {

    $reponse = new xajaxResponse();

    include("logements_presentation.php");
    $table='reservation_'.$lieu;

    include("bdd_connect.php");

    $leCalendrier = "";
    // Tableau des valeurs possibles pour un numéro de jour dans la semaine
    $tableau = Array("0", "1", "2", "3", "4", "5", "6", "0");

    $nb_jour = Date("t", mktime(0, 0, 0, getMonth($periode), 1, getYear($periode)));
    $pas = 0;
    $indexe = 1;

    // Affichage du mois et de l'année
    $leCalendrier .= "\n\t<div style=\"text-align:center;color:#ff6959;font-size:15px;font-weight:bold;\">" . monthNumToName(getMonth($periode)) . " " . getYear($periode) . "</div>";

    // Affichage des entêtes
    $leCalendrier .= "
    <ul id=\"libelle\">
        \t<li>L</li>
        \t<li>M</li>
        \t<li>M</li>
        \t<li>J</li>
        \t<li>V</li>
        \t<li>S</li>

        \t<li>D</li>
    </ul>";
    // Tant que l'on n'a pas affecté tous les jours du mois  traité
    while ($pas < $nb_jour) {
        if ($indexe == 1) $leCalendrier .=
            "\n\t<ul class=\"ligne\">";

        // Si le jour calendrier == jour de la semaine en cours
        if (Date("w", mktime(0, 0, 0, getMonth($periode),
                1 + $pas, getYear($periode))) == $tableau[$indexe]) {
            // Si jour calendrier == aujourd'hui
            $afficheJour = Date("j", mktime(0, 0, 0,
                getMonth($periode), 1 + $pas, getYear($periode)));

            if (Date("Y-m-d", mktime(0, 0, 0, getMonth($periode),
                    1 + $pas, getYear($periode))) <= Date("Y-m-d")) {
                $class = " class=\"itemPastItem\""; if (Date("Y-m-d", mktime(0, 0, 0, getMonth($periode),
                        1 + $pas, getYear($periode))) == Date("Y-m-d")) {
                    $class = " class=\"itemCurrentItem\""; }}


            else {
                $jour = Date("Y-m-d",mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode))) ;
                $rep = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND ? BETWEEN date_arrivee AND date_sub(date_depart, interval 1 day)');
                $rep->execute(array($jour));
                $dispo=$rep->fetch();


                // 1 est toujours vrai => on affiche un lien à chaque fois
                // A vous de faire les tests nécessaire si vous gérer un agenda par exemple
                if (isset($dispo['num_reservation'])) {
                    $class = " class=\"itemExistingItem\"";
                    $afficheJour=Date("j",
                        mktime(0, 0, 0, getMonth($periode), 1 +
                            $pas, getYear($periode)));

                }
                else {
                    $jour=strtotime($jour);
                    $num_id=$jour/86400;
                    $class = " class=\"itemPickableItem\" id=\"".$num_id."\" onclick=\"javascript:document.getElementById('".$num_id."').style.backgroundColor='orange';javascript:document.getElementById('".$num_id."').style.fontWeight='bold';javascript:document.getElementById('patienter').style.color='green';javascript:document.getElementById('patienter').style.fontSize='20px';xajax_pick_date(".$jour.",".$logement.",document.getElementById('cliquet').value);return false;\"";
                    $afficheJour=Date("j",
                        mktime(0, 0, 0, getMonth($periode), 1 +
                            $pas, getYear($periode)));

                }
            }
            // Ajout de la case avec la date
            $leCalendrier .= "\n\t\t<li$class>
                     $afficheJour</li>";
            $pas++;
        }
        //
        else {

            // Ajout d'une case vide
            $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
        }
        if ($indexe == 7 && $pas < $nb_jour)
        { $leCalendrier
            .= "\n\t</ul>"; $indexe = 1;} else {$indexe++;}
    }

    // Ajustement du tableau
    for ($i = $indexe; $i <= 7; $i++) {
        $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
    }
    $leCalendrier .= "\n\t</ul>\n";

    $rep->closeCursor();
    // Retour de la chaine contenant le Calendrier
    $reponse=$leCalendrier;

    // $reponse->script("
    // function pick_date2($date,$logement,$cliquet)
    // {

    // if ($cliquet==0)
    //   { document.getElementById($date).style.backgroundColor=\"orange\";
    //     document.getElementById('arrival').value=$date;
    //     document.getElementById('cliquet').value=1;

    //   }

    // else
    //   {
    //   document.getElementById($date).style.backgroundColor=\"orange\";
    //   document.getElementById('departure').value=$date;
    //   document.getElementById('cliquet').value=0;
    //   $nbre_personne=1;
    //   xajax_reserver(document.getElementById('arrival').value,document.getElementById('departure').value,$nbre_personne,$logement);
    //   }

    // }");

    return $reponse;

}


function pick_date($date,$logement,$cliquet)
{
    $reponse = new xajaxResponse();

    if ($cliquet==0){
        $reponse->script('document.getElementById(\'arrival\').value='.$date.';
        document.getElementById(\'cliquet\').value=1;
        document.getElementById(\'patienter\').style.color="white";
        document.getElementById(\'patienter\').style.fontSize="0px";
        document.getElementById(\'choose_departure\').style.color="green";
        document.getElementById(\'choose_departure\').style.fontSize="20px";
        ');
    }
    else
    {


        $reponse->script('
                        if ('.$date.' < document.getElementById(\'arrival\').value)
                          { document.getElementById(\'departure\').value=document.getElementById(\'arrival\').value;
                            document.getElementById(\'arrival\').value='.$date.';
                            document.getElementById(\'cliquet\').value=0;}
                        else

                        {document.getElementById(\'departure\').value='.$date.';
                         document.getElementById(\'cliquet\').value=0;}

                        ');
        $reponse->call('xajax_reserver(document.getElementById(\'arrival\').value,document.getElementById(\'departure\').value,document.getElementById(\'nbre_personne\').value,'.$logement.')');
    }


    return $reponse;
}


// fonctions utiles, $valeur représente une date au format AAAA-MM-JJ


function getMonth($valeur)     {
    return substr($valeur, 5, 2);
}

function getYear($valeur) {
    return substr($valeur, 0, 4);
}

function monthNumToName($mois) {
    $tableau = Array("", "Janvier", "Février",
        "Mars", "Avril", "Mai", "Juin", "Juillet",
        "Aôut", "Septembre", "Octobre", "Novembre", "Décembre");

    return (intval($mois) > 0 && intval($mois) < 13) ? $tableau[intval($mois)] : "Indéfini";
}


function editer_calendrier_Ical_CNCCV()
{
    $reponse = new xajaxResponse();

    require_once("icalendar-master/zapcallib.php");

    include("bdd_connect.php");


    $j=1;

    for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
    {
        include("logements_presentation.php");
        $table='reservation_'.$lieu;
        ${'icalobj'.$j} = new ZCiCal();
        $i=1;
        $calendrier= $bdd->query('SELECT * FROM '.$table.' WHERE date_arrivee >= current_date AND annule_le IS NULL AND calendrier_externe IS NULL');
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


    return $reponse;

}


function MAJ_calendrier_Airbnb()
{
    $reponse = new xajaxResponse();

    require_once("icalendar-master/zapcallib.php");


    for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
    {
        include('bdd_connect.php');
        include("logements_presentation.php");
        $table='reservation_'.$lieu;

        $icalfeed = curl_get_contents($icalfile);

        // create the ical object
        $icalobj = new ZCiCal($icalfeed);

        // echo "Number of events found: " . $icalobj->countEvents() . "\n";
        $calendrier_externe='AirBnb';
        // $ecount = 0;

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
                            $date_arrivee_airbnb= $value->getValues();
                            $date_arrivee_airbnb = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_arrivee_airbnb);

                        }
                        if($key == "DTEND" )
                        {
                            $date_depart_airbnb= $value->getValues();
                            $date_depart_airbnb = preg_replace('#^([1-2][09][0-9][0-9])([0|1][0-9])([0-3][0-9])$#','$1-$2-$3',$date_depart_airbnb);

                        }
                        if($key == "DESCRIPTION" )
                        {
                            $commentaire_arrivee= $value->getValues();

                        }
                    }

                    $date_arrivee_duree = new datetime($date_arrivee_airbnb);
                    $date_depart_duree = new datetime($date_depart_airbnb);
                    $nbre_nuit_reservation = $date_depart_duree->diff($date_arrivee_duree);
                    $nombre_nuit=$nbre_nuit_reservation->format('%a');


                    $rep = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND date_arrivee=? AND date_depart=?');
                    $rep->execute(array($date_arrivee_airbnb,$date_depart_airbnb));
                    $already_in=$rep->fetch();

                    $today=strtotime(date('Y-m-d'));
                    $date_a_synchro=strtotime($date_arrivee_airbnb);
                    $updated=1;

                    if (isset($already_in['num_reservation']) && $nom_prenom!='Not available')
                    {
                        $req = $bdd->prepare('UPDATE '.$table.' SET date_arrivee = ?, date_depart = ?, nom = ?, nombre_nuit = ?,commentaire_arrivee = ?, calendrier_externe = ?, updated = ? WHERE date_arrivee = ?');
                        $req->execute(array($date_arrivee_airbnb, $date_depart_airbnb, $nom_prenom, $nombre_nuit, $commentaire_arrivee,$calendrier_externe, $updated, $date_arrivee_airbnb));
                        $req->closeCursor();
                    }

                    else if (!isset($already_in['num_reservation']) && $nom_prenom!='Not available')
                    {
                        $req = $bdd->prepare('INSERT INTO '.$table.'(date_arrivee, date_depart, nom, nombre_nuit, commentaire_arrivee, calendrier_externe, updated, date_reservation) VALUES(?, ?, ?, ?, ?, ?, ?, Current_date)');
                        $req->execute(array($date_arrivee_airbnb, $date_depart_airbnb, $nom_prenom, $nombre_nuit, $commentaire_arrivee,$calendrier_externe, $updated));
                        $req->closeCursor();
                    }
                    $rep->closeCursor();
                }
            }
        }
    }

    for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
    {

        include("logements_presentation.php");
        $table='reservation_'.$lieu;

        // $updated='';
        $today=date('Y-m-d');

        $rep = $bdd->prepare('SELECT * FROM '.$table.' WHERE annule_le IS NULL AND calendrier_externe=? AND updated IS NULL');
        $rep->execute(array($calendrier_externe));
        while ($to_cancel=$rep->fetch())

        {
            $req = $bdd->prepare('UPDATE '.$table.' SET annule_le = ? WHERE num_reservation = ?');
            $req->execute(array($today, $to_cancel['num_reservation']));
            $req->closeCursor();
        }

        $req = $bdd->prepare('UPDATE '.$table.' SET updated = NULL WHERE calendrier_externe = ?');
        $req->execute(array($calendrier_externe));
        $req->closeCursor();
    }
    return $reponse;
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

require_once('xajax_core/xajax.inc.php');

$xajax = new xajax(); // On initialise l'objet xajax.

$xajax->register(XAJAX_FUNCTION, 'page_de_demarrage');
$xajax->register(XAJAX_FUNCTION, 'afficher_dispo_prix');
$xajax->register(XAJAX_FUNCTION, 'demande_annuler');
$xajax->register(XAJAX_FUNCTION, 'confirme_annuler');
$xajax->register(XAJAX_FUNCTION, 'demande_modifier');
$xajax->register(XAJAX_FUNCTION, 'confirme_modifier_supplement');
$xajax->register(XAJAX_FUNCTION, 'confirme_modifier_avoir');
$xajax->register(XAJAX_FUNCTION, 'connect_first');
$xajax->register(XAJAX_FUNCTION, 'reserver');
$xajax->register(XAJAX_FUNCTION, 'editer_devis');
$xajax->register(XAJAX_FUNCTION, 'enregistrer_reservation');
$xajax->register(XAJAX_FUNCTION, 'dispo_logement');
$xajax->register(XAJAX_FUNCTION, 'prix_logement');
$xajax->register(XAJAX_FUNCTION, 'afficher_avis');
$xajax->register(XAJAX_FUNCTION, 'afficher_calendrier');
$xajax->register(XAJAX_FUNCTION, 'showCalendar');
$xajax->register(XAJAX_FUNCTION, 'pick_date');
$xajax->register(XAJAX_FUNCTION, 'ecrire_commentaire');
$xajax->register(XAJAX_FUNCTION, 'inserer_commentaire');
$xajax->register(XAJAX_FUNCTION, 'MAJ_calendrier_Airbnb');
$xajax->register(XAJAX_FUNCTION, 'editer_calendrier_Ical_CNCCV');


$xajax->processRequest();// Fonction qui va se charger de générer le Javascript, à partir des données que l'on a fournies à xAjax APRÈS AVOIR DÉCLARÉ NOS FONCTIONS.



?>