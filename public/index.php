<script>
var dayList = [];
</script>

<?php

define('ROOT', dirname(__DIR__));
/*
require ROOT.'/app/App.php';
App::load();
*/
session_start();
require ROOT.'/app/Autoloader.php';
App\Autoloader::register();
require ROOT.'/core/Autoloader.php';
Core\Autoloader::register();

/*


require ROOT . '/app/Autoloader.php';
App\Autoloader::register();


$config = \App\Config::getInstance(ROOT.'/config/config.php');
//::Config(ROOT.'/config/config.php');
var_dump($config);
var_dump($config);var_dump($config);var_dump($config);
*/



$app = \App\App::getInstance();

if (isset($_GET['p'])) {
    $p=$_GET['p'];
} else {
    $p='accueil';
}

ob_start();

\App\App::setTitle(ucfirst($p));

if ($p==='contact'){

    require ROOT.'/Pages/contact.php';
}

elseif ($p==='profil'){

    require ROOT.'/Pages/profil.php';
}
elseif ($p==='cu'){

    require ROOT.'/Pages/cu.php';
}
elseif ($p==='ml'){

    require ROOT.'/Pages/ml.php';
}

elseif ($p==='rousseau' or $p==='champion' or $p==='painleve'){
    $carrousel=\App\Logements\Logements::getCarrousel($p);
    $parametres=$app->getParametreLogement($p);
    require ROOT.'/Pages/maison.php';
    require ROOT.'/Public/js/jsCalendrier.js';
}

else {
        require ROOT.'/Pages/accueil.php';
}


$content=ob_get_clean();

require ROOT . '/Pages/templates/default.php';


?>
