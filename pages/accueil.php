<!--intégration de la barre de navigation -->
<img class="responsive-img" src="../public/img/PanoramaLeMans.JPG" >

<?php
require '../pages/navbarHaut.php';
require '../pages/navbarBas.php';
$_SESSION['arrivee']=null;
$_SESSION['depart']=null;
$_SESSION['nombrePersonne']=null;
?>


<ul class="sidenav sidenavBig sidenavWidth" id="mobile-demo">
    <div class="bgBleuC" style="padding: 10px !important;"><h6 style="margin: 0 !important;" class="white-text align colortext1">Menu</h6></div>

    <li><a class="sideNavText" href="../Public/index.php"><span class="badge new">3</span>Toutes les maisons</a></li>
    <li><a class="sideNavText" href="contact.php">Contact</a></li>
    <li><a class="sideNavText" href="Kelvin/ml.php">Mentions légales</a></li>
    <li><a class="sideNavText" href="Kelvin/cu.php">Conditions d'utilisation</a></li>
    <li><a class="sideNavText" href="#">Qui sommes nous</a></li>
</ul>



<div class="marginTop2"></div>


<div class="row align aligncard">

    <div class="col s12 m4 l4">
        <div class="card-panel bgRouge LittleOpa cardpresen">

            <img src="../public/img/Home.png">
            <span class="white-text">
            <b>
                <h4>
                Location immobilière sur courte & moyenne durée au Mans
                </h4>
            </b>
        </span>
        </div>
    </div>

    <div class="col s12 m4 l4">
        <div class="card-panel bgBleu LittleOpa cardpresen">

            <img src="../public/img/bed.png">
            <span class="white-text">
            <b>
                <h4>
                    Bientôt de nouvelles adresses
                </h4>
            </b>
        </span>
        </div>
    </div>

    <div class="col s12 m4 l4">
        <div class="card-panel bgOrange LittleOpa cardpresen">

            <img src="../public/img/Table-Lamp.png">
            <span class="white-text">
            <b>
                <h4>
                    Mise a jour du site,
                    vous pourrez bientôt réserver en ligne
                </h4>
            </b>
        </span>
        </div>
    </div>

</div>

<div class="container">

    <div class="marginTop2 divider" style="border: 0.5px solid #C1C1C1"></div>

</div>



<div class="container marginTop2">


    <div class="row" id="AllMaison">
        <div class="col s12 m6 l4">
            <div class="card cardShadow">
                <div class="card-image">
                    <img src="../public/img/rousseau/rousseau1.JPG">
                </div>
                <div class="card-content">
                    <h5 class="align">Chez Rousseau</h5>
                    <p class="align"><i class="material-icons iconAlign">location_on</i> 193 Boulevard Jean-Jacques
                        Rousseau, 72100 Le Mans
                    </p>
                    <br>

                            <p class="align"><i style="margin-top: 15px" class="material-icons iconAlign">supervisor_account</i>
                                &nbsp;  4 personnes</p>

                </div>

                <div class="card-action">
                    <a class="colorCyan" href="index.php?p=rousseau"><b>Voir plus d'information</b></a>

                </div>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="card cardShadow">
                <div class="card-image">
                    <img src="../public/img/cnccv_prochainement.png">
                </div>
                <div class="card-content">
                    <h5 class="align">Chez Champion</h5>
                    <p class="align"><i class="material-icons iconAlign">location_on</i> &nbsp; 17 rue Henri
                        Champion, 72100 LE
                        MANS </p>
                    <p class="align "><i class="material-icons iconAlign" style="margin-top: 15px">supervisor_account</i>
                        &nbsp; 6
                        personnes
                    </p>
                </div>
                <div class="card-action">
                    <a class="colorCyan" href="index.php?p=champion"><b>Voir plus d'information</b></a>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l4">
            <div class="card cardShadow">
                <div class="card-image">
                    <img src="../public/img/cnccv_prochainement.png">
                </div>
                <div class="card-content">
                    <h5 class="align">Chez Painlevé</h5>
                    <p class="align"><i class="material-icons iconAlign">location_on</i>&nbsp; 12 square Paul
                        Painlevé 72100 LE
                        MANS </p>
                    <p class="align"><i class="material-icons iconAlign"
                                        style="margin-top: 15px">supervisor_account</i>&nbsp; 8
                        personnes
                    </p>
                </div>

                <div class="card-action">
                    <a class="colorCyan" href="index.php?p=painleve"><b>Voir plus d'information</b></a>
                </div>
            </div>
        </div>

    </div>
    <div class="marginTop2"></div>


</div>
