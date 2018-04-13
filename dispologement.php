<?php

function page_de_demarrage()
{
// ci-dessous va chercher au moins 3 logements disponibles sur des dates définies aléatoirement MAIS en partant d'aujourd'hui
    $num_reservation = 0;
    $nbre_personne = rand(1, 4);
    $nbj_alea = rand(3, 9);
    $i = 0;
    $n = 0;
    while ($i <= 3) {
        $m = $n + $nbj_alea;
        $date_arrivee_sql = date('Y-m-d', strtotime('+' . $n . ' day'));
        $date_depart_sql = date('Y-m-d', strtotime('+' . $m . ' day'));
        $i = 0;
        for ($logement = 1; $logement <= $_SESSION['nombre_de_logement']; $logement++) {
            $dispo = dispo_logement($date_arrivee_sql, $date_depart_sql, $num_reservation, $logement);

            if ($dispo == true) {
                $i++;
            }
        }
        $n++;
    }


// lignes ci-dessous permettent de passer du format Y-m-d au format d/m/Y
    $date_arrivee = strtotime($date_arrivee_sql); // ressort le nombre de secondes depuis 01/01/1970 de la date contenu dans la variable $date_arrivee_sql
    $date_depart = strtotime($date_depart_sql);
    $date_arrivee_fr = date("d/m/Y", $date_arrivee);
    $date_depart_fr = date("d/m/Y", $date_depart);

// chargement de la phrase associée à la page de démarrage
    $content = '<span>Exemple de tarif ci-dessous pour la période du <b>' . $date_arrivee_fr . '</b> au <b>' . $date_depart_fr . '</b> pour <b>' . $nbre_personne . '</b> personne(s)</span>';

    $_SESSION['page_de_demarrage'] = 1;

    $reponse->assign('page_de_demarrage', 'innerHTML', $content);
    $reponse->script('xajax_afficher_dispo_prix(' . $date_arrivee . ',' . $date_depart . ',' . $nbre_personne . ')');
    return $reponse;
}

function dispoActionTest()
{
    $arrivee = new DateTime('SELECT arrivee FROM booking');
    $depart = new DateTime('SELECT depart FROM booking');
    $depart->modify('+1 day');

    try {
        $period = new DatePeriod($arrivee, new DateInterval('P1D'), $depart);
    } catch (Exception $e) {
    }
}

/**
 * @param $arrivee
 * @param $depart
 * @param $id
 * @param $logement_id
 * @param $resa
 * @return bool
 */
function dispoAction2($arrivee, $depart, $id, $logement_id)
{
    $resa = 'SELECT * FROM booking WHERE booking.logement_id = ? AND annulation IS NULL AND ? BETWEEN arrivee AND depart';
    $resa->execute(array($logement_id, $arrivee));
    $start_dispo = $resa->fetch();
    if (isset($start_dispo['id'])) {
        if ($start_dispo['id'] == $id) {
            $start = true;
        } else {
            $start = false;
        }
    } else {
        $start = true;
    }

    $resa2 = 'SELECT * FROM booking WHERE annulation IS NULL AND ? BETWEEN arrivee AND depart';
    $resa2->execute(array($depart));
    $start_dispo = $resa2->fetch();
    if (isset($start_dispo['id'])) {
        if ($start_dispo['id'] == $id) {
            $end = true;
        } else {
            $end = false;
        }
    } else {
        $end = true;
    }

    $resa3 = 'SELECT * FROM booking WHERE annulation IS NULL AND date_add(?,INTERVAL 1 DAY) < arrivee AND date_sub(?,INTERVAL 1 DAY) > depart';
    $resa3->execute(array($arrivee, $depart));
    $start_periode = $resa3->fetch();
    if (isset($start_periode['id'])) {
        if ($start_periode['id'] == $id) {
            $periode = true;
        } else {
            $periode = false;
        }
    } else {
        $periode = true;
    }

    if ($start == true && $end == true && $periode == true) {
        $reponse = true;
    } else {
        $reponse = false;
    }

    return $reponse;
}

/**
 * @param string $arrivee
 * @param string $depart
 * @param string $format DateTime format, default is Y-m-d
 * @throws \Exception
 */
public function dispoActionTest($arrivee, $depart, $format = "Y-m-d")
{
    $arrivee = new DateTime('SELECT arrivee FROM booking INNER JOIN logement l ON booking.logement_id = l.id');
    $depart = new DateTime('SELECT depart FROM booking INNER JOIN logement l ON booking.logement_id = l.id');
    $depart = $depart->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periode = new DatePeriod($arrivee, $interval, $depart);

    if (empty([$arrivee, $depart]) === true) {
        echo 'Cette période est diponible';
    } else {
        echo 'Cette période n\'est pas disponible';
    }

    $resa = isset($periode);

    if ($resa === true) {
        echo 'Cette période n`\'est pas diponible !';
    }
}

/**
 * @param $logement_id
 * @param
 * @param  \DateTime $arrivee
 * @param  \DateTime $depart
 * @return bool
 */
public function dispoAction($logement_id, $arrivee, $depart)
{
    $qb = $this->repository->createQueryBuilder('reservation');
    $query = $qb->select('reservation.id')
        ->where('reservation.arrivee <= :arrivee AND reservation.depart >= :depart')
        ->orWhere('reservation.arrivee >= :arrivee AND reservation.depart <= :depart')
        ->orWhere('reservation.arrivee >= :arrivee AND reservation.depart >= :depart AND reservation.arrivee <= :depart')
        ->orWhere('reservation.arrivee <= :arrivee AND reservation.depart <= :depart AND reservation.depart >= :arrivee')
        ->andWhere('reservation.logement_id = :logement_id')
        ->setParameters(array(
            'arrivee' => $arrivee,
            'depart' => $depart,
            'logement_id' => $logement_id
        ));

    $results = $query->getQuery()->getResult();

    return count($results) === 0;
}