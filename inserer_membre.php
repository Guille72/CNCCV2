<?php


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
elseif (!preg_match('#.{8,}#',$_POST['password'])) 
{
echo 'Mot de passe non valide : au moins 8 caractères';
}
elseif (!preg_match('#^[0][0-9]{9,}$#',$_POST['telephone']))
{
echo 'Téléphone non valide : saisissez au moins 10 chiffres en commençant par 0';
}
else
{
	include("bdd_connect.php");

	$req = $bdd->prepare('SELECT prenom FROM membres WHERE email = :email');

	$req->execute(array(

    'email' => $_POST['email']));

    $deja_membre = $req->fetch();

    if (isset($deja_membre['prenom']))
    {
    	session_start();
    	$_SESSION['deja_inscrit'] = true;
    	header('Location: index.php');
    	
    }
    else
    {
		$prenomMAJ=ucfirst($_POST['prenom']);
        $nomMAJ=strtoupper($_POST['nom']);
        $villeMAJ=strtoupper($_POST['ville']);


		$date_naissance = preg_replace('#^([0-3][0-9])/([0|1][0-9])/([1-2][0|9][0-9][0-9])$#','$3-$2-$1',$_POST['date_naissance']);
		$pass_hache = sha1($_POST['password']);

		$req2 = $bdd->prepare('INSERT INTO membres(prenom, nom, date_naissance, adresse, code_postal, ville, telephone, email, password, date_inscription) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, Current_date)');

		$req2->execute(array($prenomMAJ, $nomMAJ, $date_naissance, $_POST['adresse'], $_POST['code_postal'], $villeMAJ, $_POST['telephone'], $_POST['email'], $pass_hache));
		
		session_start();

		$_SESSION['prenom'] = $prenomMAJ;
    	$_SESSION['nom'] = $nomMAJ;
    	$_SESSION['date_naissance'] = $_POST['date_naissance'];
    	$_SESSION['adresse'] = $_POST['adresse'];
		$_SESSION['code_postal'] = $_POST['code_postal'];
		$_SESSION['ville'] = $villeMAJ;
    	$_SESSION['email'] = $_POST['email'];
    	$_SESSION['telephone'] = $_POST['telephone'];
    	
    	for ($logement=1;$logement <=$_SESSION['nombre_de_logement'];$logement++)
    	{
    		include("logements_presentation.php");
    		$_SESSION['a_commenter_'.$lieu] = null;
    	}
  
    	
    	$req3 = $bdd->prepare('SELECT id FROM membres WHERE email = :email');

		$req3->execute(array(

    	'email' => $_POST['email']));

    	$recup_id = $req3->fetch();
		$_SESSION['id'] = $recup_id['id'];

			$dossier='./Clients/'.$nomMAJ.' '.$prenomMAJ.'-'.$_SESSION['id'];
			$dossier = str_to_noaccent($dossier);
			mkdir($dossier, 0644);
			$taille_maxi = 10000000;
			$taille = filesize($_FILES['cni']['tmp_name']);
			$extensions = array('.png', '.gif', '.jpg', '.jpeg','.pdf');
			$extension = strrchr($_FILES['cni']['name'], '.'); 
			$fichier = 'Clients/'.$nomMAJ.' '.$prenomMAJ.'-'.$_SESSION['id'].'/'.$nomMAJ.' '.$prenomMAJ.'-'.$_SESSION['id'].$extension;
			$fichier = str_to_noaccent($fichier);
			//Début des vérifications de sécurité...
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
			     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
			}
			if($taille>$taille_maxi)
			{
			     $erreur = 'Le fichier est trop gros...';
			}
			//if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
			//{
			     //On formate le nom du fichier ici...

			     $resultat=move_uploaded_file($_FILES['cni']['tmp_name'], $fichier);
			     if($resultat) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			     {
			          echo 'Upload effectué avec succès !';
			     }
			     else //Sinon (la fonction renvoie FALSE).
			     {
			          echo 'Echec de l\'upload !';
			     }
			//}
			/*else
			{
			     echo $erreur;
			}*/


		if (isset($_SESSION['reservation'])) 
		{
			header('Location: reserver.php');
		}
		else
		{
		header('Location: ChezNouscommeChezVous.php');
		}
	}	
}

function str_to_noaccent($str)
{
    $url = $str;
    $url = preg_replace('#Ç#', 'C', $url);
    $url = preg_replace('#ç#', 'c', $url);
    $url = preg_replace('#è|é|ê|ë#', 'e', $url);
    $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
    $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
    $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);
    $url = preg_replace('#ì|í|î|ï#', 'i', $url);
    $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
    $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
    $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
    $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
    $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
    $url = preg_replace('#ý|ÿ#', 'y', $url);
    $url = preg_replace('#Ý#', 'Y', $url);
     
    return ($url);
}

?>