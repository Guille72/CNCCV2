<?php

for ($logement=1 ; $logement <=$_SESSION['nombre_de_logement'];$logement++)
{
        include("logements_presentation.php");
        $_SESSION['a_commenter_'.$lieu]=null;
        $table='reservation_'.$lieu;

        $a_deja_reserve_logement= $bdd->prepare('SELECT * FROM '.$table.' WHERE id_membre = ?');
        $a_deja_reserve_logement->execute(array($_SESSION['id']));
        $reponse_logement=$a_deja_reserve_logement->fetch();
        $a_deja_reserve_logement->closeCursor();

    if (!$reponse_logement)
    {
        $_SESSION['jamais_reserve_'.$lieu] = true;
    }
    else
    {
       $visite_recente_logement= $bdd->query('SELECT * FROM '.$table.' WHERE date_depart < current_date AND annule_le IS NULL');
        while($derniere_visite_logement=$visite_recente_logement->fetch())
            {
                if ($derniere_visite_logement['id_membre']==$_SESSION['id'])
                {
                    if (!isset($derniere_visite_logement['commentaire']))
                        {  $_SESSION['a_commenter_'.$lieu] = true;
                            $_SESSION['date_depart_'.$lieu] = $derniere_visite_logement['date_depart'];
                            $_SESSION['num_reservation_commentaire_'.$lieu]=$derniere_visite_logement['num_reservation'];
                            }
                    else
                        {  $_SESSION['a_commenter_'.$lieu] = null; }
                }
            }
        $visite_recente_logement->closeCursor(); 


        $i=0;
        $reservation_prochaine_logement= $bdd->prepare('SELECT * FROM '.$table.' WHERE date_arrivee >= current_date AND id_membre = ?');
        $reservation_prochaine_logement->execute(array($_SESSION['id']));
        while($resa_logement=$reservation_prochaine_logement->fetch())
            {
                $i=$i+1;
                
                $prix_paye=$resa_logement['prix']+$resa_logement['supplement']-$resa_logement['avoir'];

                $_SESSION['resa_'.$lieu.$i]= array($resa_logement['date_arrivee'],$resa_logement['date_depart'],$resa_logement['nombre_personne'],$resa_logement['num_reservation'],$resa_logement['nombre_nuit'],$prix_paye,$resa_logement['annule_le'],$resa_logement['supplement'],$resa_logement['avoir'],$resa_logement['date_reservation']);
            }
        $reservation_prochaine_logement->closeCursor();

    }
}


?>