<?php require("header.php") ?>

<?php require("navbar.php") ?>

<div style="height: 150px;"></div>


<div class="marginTop hide-on-large-only"></div>


<h5 class="colortext center-align">Envie de donner votre avis ?</h5>

<div class="container DivContact">
    <!--Formulaire de contact-->
    <form class="margin30px" method="post" action="">

        <div class="row">

            <div class="form-group col s12 m6 l6">
                <div class="row">
                    <div class="col offset-m1 offset-l1 offset-s1">
                        <label class="white-text"><h6>Votre nom</h6></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s1 m1 l1" style="height: 50px">
                        <i class="material-icons small white-text" style="margin-top: 20px">account_circle</i>
                    </div>
                    <div class="col s1 m1 hide-on-large-only"></div>
                    <div class="col s10 m10 l11">
                        <input type="text" id="name" name="name" class="input_form form-control"/>
                    </div>
                </div>

            </div>


            <div class="form-group col s12 m6 l6">
                <div class="row">
                    <div class="col offset-m1 offset-l1 offset-s1">
                        <label class="white-text"><h6>Votre mail</h6></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s1 m1 l1" style="height: 50px">
                        <i class="material-icons small white-text" style="margin-top: 20px">mail</i>
                    </div>
                    <div class="col s1 m1 hide-on-large-only"></div>
                    <div class="col s10 m10 l11">
                        <input type="text" id="email" name="email" class="form-control input_form"/>
                    </div>
                </div>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="form-group col s10 offset-s1 m8 offset-m2">
                <label class="white-text"><h6>Votre sujet</h6></label>
                <input type="text" id="subject" name="subject" class="form-control input_form"/></label>
            </div>

        </div>

        <br>

        <div class="form-group ">
            <label class="white-text"><h6>Votre message</h6></label>
            <textarea id="message" name="message" class="form-control textarea_form"></textarea>
        </div>


        <br>

        <div class="row">
            <div class="col s6 m6 l6 white-text">
                Accepter nos <a target="_blank" href="Kelvin/cu.php">Conditions d'utilisations</a>
                <label class="white-text">
                    <input class="white white-text" id="indeterminate-checkbox" name="checkCU"
                           type="checkbox" style="background-color: white !important;"/>
                    <span class="white-text"></span>
                </label>
            </div>
            <div class="form-group col s4 m4 l4" align="center">

                <input type="submit" onclick="M.toast({html: 'Message envoyé. Merci!',classes: 'rounded toastSend'})"
                       id="submit" name="submit" value="Envoyer" class="btn white colortext"
                       style="width: 100%"/>
            </div>
        </div>
    </form>
</div>

<div class="marginTop2"></div>


<?php require("footer.php") ?>

<?php require("footerHtml.php") ?>



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Préparer la fonction pour le formulaire
function envoieMail($name, $subject, $message, $email, $file)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'ssl0.ovh.net';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contact@cnccv.fr';                 // SMTP username
        $mail->Password = 'Glservices2018';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('contact@cnccv.fr', 'CNcCV');
        $mail->addAddress("$email", "$name");     // Add a recipient


        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "$subject";
        $mail->Body = "$message";
        $mail->AltBody = "$message";

        if (!empty($file)) {
            $mail->addAttachment('', '', '', '', '');
        }

        $mail->send();

        $msgEnvoyer = "M.toast({html: 'Message envoyé'});";

    } catch (Exception $e) {
        $msgEnvoyer = "M.toast({html: 'Erreur, message non envoyé'})";
    }
}

// 2 Mails d'un coup par le formulaire
if (isset($_POST['email'])) {
    // Pour le client
    $nom = !empty($_POST['name']) ? $_POST['name'] : NULL;
    $sujet = 'Votre commentaire sur CNcCV';
    $contenu = "Bonjour $nom <br/> Merci de votre passage sur <a href='http://www.cnccv.fr/'>CNcCV</a> ! Nous lirons ce mail le plus vite possible";
    $adresseMail = !empty($_POST['email']) ? $_POST['email'] : NULL;
    // Prévoir l'envoie de fichier
    $fichier = NULL;
    envoieMail($_POST['name'], $sujet, $contenu, $_POST['email'], $fichier);

    // Pour CNcCV
    // Le 2 pour différencier du client (pas obligé)
    $adresseMail2 = 'contact@cnccv.fr';
    $sujet2 = "Commentaire de $nom";
    $contenu2 = !empty($_POST['message']) ? $_POST['message'] : NULL;
    // $fichier ne change pas pour le moment
    envoieMail($_POST['name'], $sujet2, $contenu2, $adresseMail2, $fichier);
}

?>

<script>

    document.getElementById("navbar").classList.add("sticky");

</script>
