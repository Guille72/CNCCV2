<?php 

error_reporting( E_ALL );


include("bdd_connect.php");
// Hachage du mot de passe

$pass_hache = sha1($_POST['password']);


// Vérification des identifiants

$req = $bdd->prepare('SELECT * FROM membres WHERE email = :email AND password = :password');

$req->execute(array(

    'email' => $_POST['email'],

    'password' => $pass_hache));


$resultat = $req->fetch();


if (!$resultat)
{
 	session_start();
 	$_SESSION['mauvais_password'] = true;
 	header('Location: index.php');
}

else
{
    session_start();
   
	$_SESSION['id'] = $resultat['id'];
    $_SESSION['prenom'] = $resultat['prenom'];
    $_SESSION['nom'] = $resultat['nom'];
    $_SESSION['adresse'] = $resultat['adresse'];
    $_SESSION['code_postal'] = $resultat['code_postal'];
    $_SESSION['ville'] = $resultat['ville'];
    $_SESSION['date_naissance'] = preg_replace('#^([1-2][09][0-9][0-9])-([0|1][0-9])-([0-3][0-9])$#','$3/$2/$1',$resultat['date_naissance']);
    $_SESSION['email'] = $resultat['email'];
    $_SESSION['telephone'] = $resultat['telephone'];

    include("recap_reservation_commentaire.php");
   

        if (isset($_SESSION['reservation'])) 
        {
            header('Location: reserver.php');
        }
        else
        {
        header('Location: index.php');
        }
}
?>