<!doctype html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<html lang="en" id="html">
<head>
    <link rel="icon" type="image/png" href="../public/img/logo_cnccv6150150.png"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link type="text/css" href="../public/css/materialize.css" rel="stylesheet">
    <link type="text/css" href="../public/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

    <title> <?= App\App::getTitle(); ?> </title>

</head>
<body>

<!--intégration des pages depuis index.php et méthode get -->

<div>
    <?= $content; ?>
</div>



<!-- FOOTER version pour PC -->
<footer class="page-footer hide-on-med-and-down" id="footer" style="background-color: #EA0C4D; padding-top: 20px !important;">
    <div class="container">
        <div class="row">
            <div class="col l6 s12" style="margin-bottom: 40px">
                <h5 class="white-text">Chez Nous comme Chez Vous</h5>
                <p class="grey-text text-lighten-4">Location de maison sur courte et moyenne durée au Mans</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Liens</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="index.php?p=ml">Mentions légales</a></li>
                    <li><a class="grey-text text-lighten-3" href="index.php?p=cu">Conditions d'utilisations</a></li>
                    <li><a class="grey-text text-lighten-3" href="#">Qui sommes nous</a></li>
                    <br>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright" style="background-color:#CE003E">
        <div class="container align">
            © 2018 Copyright CNcCV
        </div>
    </div>
</footer>


<!-- FOOTER version pour tablette et smartphone -->
<footer class="page-footer hide-on-large-only" id="footer" style="background-color: #EA0C4D ; padding-top: 20px !important;">
    <div class="container">
        <div class="col s12" style="text-align: center;">
            <h5 class="white-text">Chez Nous comme Chez Vous</h5>
            <p class="grey-text text-lighten-4">Location de maison sur courte et moyenne durée au Mans</p>
        </div>

        <br>
    </div>
    <div class="footer-copyright" style="background-color:#CE003E">
        <div class="container" style="text-align: center">

            © 2018 Copyright CNcCV
        </div>
    </div>
</footer>



<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script type="text/javascript"  src="../public/js/materialize.js"></script>

<script>

    M.AutoInit();

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);




    });



    $(document).ready(function(){
        $('.sidenav').sidenav();
    });




</script>


</body>
</html>
