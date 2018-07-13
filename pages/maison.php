<?php
require '../pages/navbarHaut.php';

// instanciation de Sejour
$Sejour=$app->getSejour($_POST);
//Affichage du formulaire
$Formulaire= $Sejour->formulaireSejour();
echo $Formulaire;

//Traitement des résultats du formulaire
if ($_POST!=null) {
    $dispoPrix = $Sejour->dispoPrix();

    $_SESSION['arrivee']= date("d/m/Y", strtotime($_POST['arrivee']));
    $_SESSION['depart']= date("d/m/Y",strtotime($_POST['depart']));
    $_SESSION['NombrePersonne']=$_POST['NombrePersonne'];
    require ROOT.'/settings/maisons.php';
    foreach ($maisons as $maison) {
        $_SESSION[$maison]=$dispoPrix[$maison];
    }
}

//Affichage de la Barre de navigation selon résultats (ou non) du formulaire
if ($_SESSION['arrivee']!=null) {
    require 'navbarBasAvecPost.php';
}else {
    require 'navbarBas.php';
}

?>

<div style="height: 500px; border-bottom: 0.5px solid black">
   <div class="carousel col m12 s12 l12">
            <?= $carrousel ?>
    </div>
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
