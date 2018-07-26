<?php require '../pages/navbarHaut.php';
if ($_SESSION['arrivee']!=null) {
    require 'navbarBasAvecPost.php';
}else {
    require 'navbarBas.php';
}
?>

<div class="container">

    <div class=" hide-on-large-only" STYLE="margin-top: 60% !important;"></div>
    <div class="marginTop3 hide-on-med-and-down"></div>

    <h3 class="align">Mentions légales</h3>
    <br><br>


    <h5 class="colortext">&#149; Identification de l'éditeur et de l'hébergeur du site</h5>
    <br>

    <p>Le site http://www.cnccv.fr est édité par GL Services SAS au capital de 2000 €, entreprise immatriculée au RCS de Le Mans sous le numéro 832314587, dont le siège social est sis au 193, boulevard Jean-Jacques Rousseau , 72100 LE MANS.
        N° de TVA intracommunautaire : FR 37 832 314 587.</p><br>

    <p>Directeur de la publication : Guillaume LAVERNHE, Président de GL Services SAS, joignable au 0663492655 ou à l'adresse guillaume.lavernhe@cnccv.fr.</p><br>

    <p>   Le site est hébergé par OVH, 2 rue kellermann BP 80157 59053 ROUBAIX Cedex 1.</p><br>

    <p>Les informations concernant la collecte et le traitement des données personnelles (politique et déclaration) sont fournies dans la charte de données personnelles du site.
    </p><br>

    <div class="divider"></div>

    <br>

    <p class="align"> Tous droits réservés - 23 avril 2018</p>

</div>

<div class="marginTop2">    </div>



<script>
    document.getElementById("navbar").classList.add("sticky");
</script>
