<?php
use Carbon\Carbon;
/**
 * @param $date
 * @return string
 */
function Price($date)
{
    $qb = $this->repository->createQueryBuilder('booking');
    $results = $qb->select('*')
        ->where($date >= 'dateEntree')
        ->andWhere($date <= 'dateDepart')
        ->getQuery()
        ->getResult();
    if (isset($results)) {
        $prix = $results['prix'];
    } else {
        $prixDef = 'SELECT prixDef FROM parametres_prix';
// Manque une ligne
        $prix = $prixDef;
    }
    return $prix;
}
/**
 * @param $dateEntree
 * @param $dateDepart
 * @return int|string
 * @throws Exception
 */
function Sejour($dateEntree, $dateDepart)
{
    $prixSejour = 0;
    $dateEntree = Carbon::create($dateEntree);
    $dateDepart = Carbon::create($dateDepart);
    $nbNuit = $dateEntree->diffInDays($dateDepart);
    /*
    $interval = new DateInterval('P1D');
    $test = new DatePeriod($dateEntree, $interval, $dateDepart);
    */
    $i = 0;
    while ($i <= $nbNuit) {
        $prixJour = Price($dateEntree);
        $prixSejour = $prixSejour + $prixJour;
        $dateEntree->addDay();
        $i++;
    }
    /*
    for ($date = $dateEntree; $dateDepart; $date++) {
        $prixJour = Price($date);
        $prixSejour = $prixSejour + $prixJour;
    }
    */
    return $prixSejour;
}
/**
 * @param $dateEntree
 * @param $dateDepart
 * @param $nbPers
 * @param $logement
 * @return float|int|string
 * @throws Exception
 */
function PrixFinal($dateEntree, $dateDepart, $nbPers, $logement)
{
    $prixFinal = Sejour($dateEntree, $dateDepart);
    $coef = 'SELECT coefPrix FROM logement WHERE id = 1';
    $prixFinal = $prixFinal * $coef;
    $coefPers = 'SELECT coef_perso_supp FROM parametres_prix WHERE id = 1';
    if ($nbPers > 2) {
        $prixFinal = (1 + ($nbPers - 2) * $coefPers) * $prixFinal;
    }
    $dateEntree = Carbon::create($dateEntree);
    $dateDepart = Carbon::create($dateDepart);
    $nbNuit = $dateEntree->diffInDays($dateDepart);
    if ($nbNuit <= 8) {
        $jourMenage = 8;
    } elseif ($nbNuit > 8 and $nbNuit <= 16) {
        $jourMenage = 16;
    }
    $coefMenage = floor($nbNuit / $jourMenage);
    if ($nbNuit - ($coefMenage * $jourMenage) > 2) {
        $coefMenage = $coefMenage + 1;
    }
    $prixMenage = 'SELECT forfait_menage_ttc FROM parametres_prix WHERE id = 1';
    $prixFinal = (1 + $coefMenage) * $prixMenage * $prixFinal;
    return $prixFinal;
}
?>