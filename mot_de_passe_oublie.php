<?php  

session_start();            
            try
            {
                $bdd2 = new PDO('mysql:host=localhost;dbname=monchemoi_base;charset=utf8', 'root', '');
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            }

          

            $cherche_mail = $bdd2->prepare('SELECT password FROM membres WHERE email=:email_mdp_oublie');
            $cherche_mail->execute(array(
                    'email_mdp_oublie' =>  $_POST['email_mdp_oublie']));
            $mail_existe=$cherche_mail->fetch();
			
		

            if (isset($mail_existe))
            {
		            $password = $mail_existe['password'];
					$mail = $_POST['email_mdp_oublie']; // Déclaration de l'adresse de destination.
					
					if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $_POST['email_mdp_oublie'])) // On filtre les serveurs qui rencontrent des bogues.
							{
							    $passage_ligne = "\r\n";
							}
							else
							{
							    $passage_ligne = "\n";
							}
					//=====Déclaration des messages au format texte et au format HTML.

					$message_txt = "Bonjour, Votre mot de passe sur le site monchemoi.com est : ".$password.".";

					$message_html = "<html><head></head><body><b>Bonjour</b>, Votre mot de passe sur le site monchemoi.com est : ".$password."</body></html>";

					//==========

					 

					//=====Création de la boundary

					$boundary = "-----=".md5(rand());

					//==========

					 

					//=====Définition du sujet.

					$sujet = "Mot de passe oublié, site Monchemoi.com !";

					//=========

					 

					//=====Création du header de l'e-mail.

					$header = "From: \"Guillaume\"<cheznousaumans@hotmail.com>".$passage_ligne;

					$header.= "Reply-to: \"Guillaume\" <cheznousaumans@hotmail.com>".$passage_ligne;

					$header.= "MIME-Version: 1.0".$passage_ligne;

					$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

					//==========

					 

					//=====Création du message.

					$message = $passage_ligne."--".$boundary.$passage_ligne;

					//=====Ajout du message au format texte.

					$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

					$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

					$message.= $passage_ligne.$message_txt.$passage_ligne;

					//==========

					$message.= $passage_ligne."--".$boundary.$passage_ligne;

					//=====Ajout du message au format HTML

					$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

					$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

					$message.= $passage_ligne.$message_html.$passage_ligne;

					//==========

					$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

					$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

					//==========

					 

					//=====Envoi de l'e-mail.

					mail($mail,$sujet,$message,$header);

								//==========

					  }

			  	else

			  		{

			  			echo "<script>alert(\"Désolé je ne vous trouve pas parmi nos membres ! Inscrivez-vous ou contactez-nous...\")</script>";
			  		}
?>