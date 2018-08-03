<?php
require '../pages/navbarHaut.php';


// instanciation de Sejour
$Sejour=$app->getSejour($_POST);


//Traitement des résultats du formulaire
if ($_POST!=null) {$dispoPrix = $Sejour->dispoPrix();}

//Affichage de la Barre de navigation selon résultats (ou non) du formulaire
if ($_SESSION['arrivee']!=null) {
    require 'navbarBasAvecPost.php';
    require 'resultatMaison.php';
}else {
    require 'navbarBas.php';
}

//Instanciation du calendrier
$Calendrier=$app->getCalendrier($_SESSION);
$Calendar=$Calendrier->afficherCalendrier($_GET['p']);

//Instanciation des fonctionnalités du formulaire
$Form=new \App\Formulaire($_SESSION);

require 'resa.php';

?>


<div class="container">

   <div class="carousel col m12 s12 l12">
            <?=  $carrousel ?>
    </div>

    <div class="row">
        <div class="col m6 l6 s12">
            <div class="card" id="animInfo1">
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

        <div class="col m6 m6 s12">
            <div class="card" id="animInfo2">
                <div class="card-content">
                    <span class="card-title"><i class="material-icons">location_on</i>À quelques pas </span>

                    <?= $parametres['Description']; ?>

                </div>
            </div>
        </div>

    </div>

</div>




<iframe src="<?= $parametres['Googlemap']; ?>" width="100% !important;" frameborder="0" style="border:0; height: 250px !important;" allowfullscreen></iframe>



<script type="text/javascript">
    M.AutoInit();
</script>
