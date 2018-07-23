<?php
require '../pages/navbarHaut.php';

//Traitement des résultats du formulaire
if ($_POST!=null) {$Sejour=$app->getSejour($_POST);$dispoPrix = $Sejour->dispoPrix();}

//Affichage de la Barre de navigation selon résultats (ou non) du formulaire
if ($_SESSION['arrivee']!=null) {
    require 'navbarBasAvecPost.php';
    require 'resultatMaison.php';
}else {
    require 'navbarBas.php';
}

//Instanciation du calendrier
$Calendrier=$app->getCalendrier($_SESSION);
$Calendar=$Calendrier->afficherCalendrier($_GET['p'],2);

//Instanciation des fonctionnalités du formulaire
$Form=new \App\Formulaire($_SESSION);


?>


<!-- formulaire "Séjour" : arrivée, départ, Nombre de personnes -->

<Form method="post" action="">
    <div id="resaForm" >
        <!-- Titre -->
        <div id="titleForm">
            <h5>Reservez dès maintenant</h5>
        </div>

        <!-- Selection du nb de personnes -->
        <div id="nbPersonne">
            <p class="range-field">'.
                <label>Nombre de personnes</label>

                <?= $Form->input('range','NombrePersonne','','','min="1" max="8"') ?>
               <!-- <input type="range" id="nbPers" name="NombrePersonne" /> -->
                <div id="nbPersonneChosen"></div>
            </p>
        </div>

        <!-- Choix de la date -->
        <div id="dataPickerForm" class="row">

            <div class="col s6">
                <label>Arrivée</label>
                <?= $Form->input('text','arrivee','datepicker','','') ?>
            </div>

            <div class="col s6">
                <label>Départ</label>
                <?= $Form->input('text','depart','datepicker','','') ?>
            </div>

          </div>


          <!-- Button submit -->
        <div id="submitResaForm" class="row">

            <div class="col s12">
                <?= $Form->submit('action','btn waves-effect waves-light bgBlueForm','Poursuivre ma réservation
                    <i class="material-icons right">send</i>') ?>
            </div>

        </div>

    </div>
</form>





<div style="height: 500px; border-bottom: 0.5px solid black">
   <div class="carousel col m12 s12 l12">
            <?=  $carrousel ?>
    </div>
 </div>
<div style="margin: 0 auto;font-size:25px;font-weight:bold;color:#ff6959;margin-bottom:20px;text-align: center;"> Calendrier Chez <?= ucfirst($_GET['p'])?></div>
<div style="display: flex;flex-wrap: wrap;justify-content: center;align-items:baseline;">
    <?=  $Calendar; ?>
</div>
<div style="height: 600px" class="marginTop2" >

    <div class="row">
        <div class="col m9 s12 offset-m3">
            <div class="card displayNone divBorder1" id="animInfo1">
                <div class="card-content">

                    <span class="card-title">Équipements </span>

                    <i class="material-icons">wifi</i> Wifi <br>
                    <i class="material-icons">tv</i> Télévision <br>
                    <i class="material-icons">computer</i> Espace de travail pour ordinateur portable <br>
                    <i class="material-icons">local_dining</i> Cuisine tout équipée <br>
                    <i class="material-icons">time_to_leave</i> Place de parking dans la rue <br>
                    <i class="material-icons">directions_bike</i> Garage sur place pour vélo et moto

                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col m9 s12">
            <div class="card displayNone divBorder1" id="animInfo2">
                <div class="card-content">
                    <span class="card-title">À quelques pas..</span>

                    <?= $parametres['Description']; ?>

                </div>
            </div>
        </div>

    </div>

</div>

<?= $parametres['Googlemap']; ?>


<script>
    window.onscroll = function() {serieAnim()};
    function serieAnim() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            document.getElementById("animInfo1").classList.remove("displayNone");
            document.getElementById("animInfo1").classList.add("animInfo1");
        }

        if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
            document.getElementById("animInfo2").classList.remove("displayNone");
            document.getElementById("animInfo2").classList.add("animInfo2");
        }
    }
    M.AutoInit();

    $('.carousel.carousel-slider').carousel({
        indicators:true,
        interval:500,
        transition:300,
        fullWidth:true
    });


    var instance = M.Carousel.getInstance(elem);

    instance.next(3);

</script>
