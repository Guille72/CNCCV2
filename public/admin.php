<?php

use \Core\Auth\DBAuth;

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
$auth = new DBAuth($app->getDb());
if (!$auth->logged()){
    $app->forbidden();
}


if (isset($_GET['p'])) {
    $p=$_GET['p'];
} else {
    $p='accueil';
}

ob_start();

\App\App::setTitle(ucfirst($p));

if ($p==='contact'){

    require ROOT . '/Pages/admin/contact.php';
}

elseif ($p==='profil'){

    require ROOT . '/Pages/admin/profil.php';
}

elseif ($p==='rousseau' or $p==='champion' or $p==='painleve'){
    $carrousel=\App\Logements\Logements::getCarrousel($p);
    $parametres=$app->getParametreLogement($p);
    require ROOT . '/Pages/admin/maison.php';
}

else {
    require ROOT . '/Pages/admin/accueil.php';
}


$content=ob_get_clean();

require ROOT . '/Pages/templates/default.php';


?><?php
/**
 * Created by PhpStorm.
 * User: GL Services 01
 * Date: 22/06/2018
 * Time: 11:27
 */