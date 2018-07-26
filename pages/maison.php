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


?>

<div class="row">

<div class="col s12 m4 l4" style="margin-left: 0 !important; left: 0 !important;padding:0 !important;">

  <!-- formulaire "Séjour" : arrivée, départ, Nombre de personnes -->
  <ul class="collapsible">
      <li>
        <div class="collapsible-header" style="padding:0!important;">
  <Form method="post" action="" class="col s12 m12 l12" style="margin-left: 0 !important;left: 0 !important;padding:0 !important;">
      <div id="resaForm">
          <!-- Titre -->
          <div id="titleForm">
              <br>
              <h5>Reservez dès maintenant</h5>
          </div>

          <!-- Selection du nb de personnes -->
          <div id="nbPersonne">
              <p class="range-field">'.
                  <label>Nombre de personnes</label>

                    <?= $Form->input('number','NombrePersonne','','','min="1" max="8"') ?>
                   <!-- <input type="range" id="nbPers" name="NombrePersonne" /> -->

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

          <br>

          <div class="titleCal"> Disponibilité Chez <?= ucfirst($_GET['p'])?></div>
          <div class="contentCal">
              <?=  $Calendar; ?>
          </div>
          <br>
      </div>
  </form>

</div>
<?php if ($_SESSION['arrivee']!=null) {
    require 'resultatMaison.php';
} ?>
</li>
</ul>
</div>

<div class="col s12 m8 l8">



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



<script>
    // window.onscroll = function() {serieAnim()};
    // function serieAnim() {
    //     if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    //         document.getElementById("animInfo1").classList.remove("displayNone");
    //         document.getElementById("animInfo1").classList.add("animInfo1");
    //     }
    //
    //     if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
    //         document.getElementById("animInfo2").classList.remove("displayNone");
    //         document.getElementById("animInfo2").classList.add("animInfo2");
    //     }
    // }
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
