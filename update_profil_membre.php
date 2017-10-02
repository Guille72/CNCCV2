<?php
session_start();

if (!preg_match('#^[a-zA-Zéèç \-â]+$#',$_POST['prenom']))
{
  echo 'Erreur dans votre prénom';
}
elseif (!preg_match('#^[a-zA-Zéèç \-â]+$#',$_POST['nom']))
{
  echo 'Erreur dans votre nom';
}
elseif (!preg_match('#^[0-3][0-9]/[0|1][0-9]/[1|2][0|9][0-9][0-9]$#',$_POST['date_naissance']))
{
  echo 'Erreur dans votre date de naissance : format à respecter jj/mm/aaaa';
}
elseif (!preg_match('#^[0-9a-zA-Zéèç \-â,]+$#',$_POST['adresse']))
{
  echo 'Erreur sur votre Adresse';
}
elseif (!preg_match('#^[0-9]{5}$#',$_POST['code_postal']))
{
  echo 'Code Postal non valide : saisissez au moins 5 chiffres';
}
elseif (!preg_match('#^[a-zA-Zéèç \-â]+$#',$_POST['ville']))
{
  echo 'Erreur sur le nom de votre Ville';
}
elseif (!preg_match('#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$#',$_POST['email']))
{ 
echo 'Email non valide';  
}
elseif (!preg_match('#^[0][0-9]{9,}$#',$_POST['telephone']))
{
echo 'Téléphone non valide : saisissez au moins 10 chiffres en commençant par 0';
}
elseif (isset($_POST['password']) and (!preg_match('#.{8,}#',$_POST['password'])))
{
echo 'Mot de passe non valide : au moins 8 caractères';
}
elseif (isset($_POST['password']) and (preg_match('#.{8,}#',$_POST['password'])))
{

           try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=monchemoi_base;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }

            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
              $prenomMAJ=ucfirst($_POST['prenom']);
              $nomMAJ=strtoupper($_POST['nom']);
              $villeMAJ=strtoupper($_POST['ville']);
              $date_naissance = preg_replace('#^([0-3][0-9]/)([0|1][0-9]/)([1-2][09][0-9][0-9])$#','$3-$2-$1',$_POST['date_naissance']);
              
              
              $pass_hache = sha1($_POST['password']);

              $req2 = $bdd->prepare('UPDATE membres SET prenom = ?, nom = ?, date_naissance = ?, adresse = ?,code_postal = ?, ville = ?,telephone = ?, email= ?, password =? WHERE id = ?');

              $req2->execute(array($prenomMAJ, $nomMAJ, $date_naissance, $_POST['adresse'], $_POST['code_postal'],$villeMAJ,$_POST['telephone'], $_POST['email'], $pass_hache, $_SESSION['id']));
              
              

                $_SESSION['prenom'] = $prenomMAJ;
                $_SESSION['nom'] = $nomMAJ;
                $_SESSION['date_naissance'] = $_POST['date_naissance'];
                $_SESSION['adresse'] = $_POST['adresse'];
                $_SESSION['code_postal'] = $_POST['code_postal'];
                $_SESSION['ville'] = $villeMAJ;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['telephone'] = $_POST['telephone'];
                $_SESSION['updated'] = true;
              header('Location: profil_membre.php');
}
else
{
            try
            {
                $bdd = new PDO('mysql:host=localhost;dbname=monchemoi_base;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }

            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
              $prenomMAJ=ucfirst($_POST['prenom']);
              $nomMAJ=strtoupper($_POST['nom']);
              $villeMAJ=strtoupper($_POST['ville']);

              $date_naissance = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][09][0-9][0-9])$#','$3-$2-$1',$_POST['date_naissance']);

              $req2 = $bdd->prepare('UPDATE membres SET prenom =?, nom =?, date_naissance=?, adresse = ?,code_postal = ?, ville = ?, telephone=?, email=? WHERE id = ?');

              $req2->execute(array($prenomMAJ, $nomMAJ, $date_naissance, $_POST['adresse'], $_POST['code_postal'],$villeMAJ,  $_POST['telephone'], $_POST['email'], $_SESSION['id']  ));
                  
                $_SESSION['prenom'] = $prenomMAJ;
                $_SESSION['nom'] = $nomMAJ;
                $_SESSION['date_naissance'] = $_POST['date_naissance'];
                $_SESSION['adresse'] = $_POST['adresse'];
                $_SESSION['code_postal'] = $_POST['code_postal'];
                $_SESSION['ville'] = $villeMAJ;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['telephone'] = $_POST['telephone'];
                $_SESSION['updated'] = true;

              header('Location: profil_membre.php');
}
          
?>
