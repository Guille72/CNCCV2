<?php

namespace Cnccv\HouseBundle\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homePage" )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logements = $em->getRepository('CnccvHouseBundle:Logement')->findAll();

        return $this->render('CnccvHouseBundle:Default:index.html.twig', array(
            'logements' => $logements,
        ));

    }

    /**
     * @Route (name="dispo")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dispoLogementAction()
    {
        $id = 'SELECT id FROM booking';
        $logement_id = 'SELECT logement_id FROM booking';
        $arrivee = 'SELECT arrivee FROM booking';
        $depart = 'SELECT depart FROM booking';
        $array = array($logement_id, $arrivee);

        $resa = 'SELECT * FROM booking WHERE logement_id = ? AND annulation IS NULL AND ? BETWEEN arrivee AND date_sub(depart, interval 1 day)';
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

        $resa2 = 'SELECT * FROM booking WHERE logement_id = ? AND annulation IS NULL AND ? BETWEEN date_add(arrivee,interval 1 day) AND depart';
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

        $resa3 = 'SELECT * FROM booking WHERE logement_id = ? AND annulation IS NULL AND date_add(?,INTERVAL 1 DAY) < arrivee AND date_sub(?,INTERVAL 1 DAY) > depart';
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

        return $this->render('CnccvHouseBundle:Default:index.html.twig', array(
            'reponse' => $reponse,));
    }

    /**
     * @Route (name="prix")
     * @return int|string
     */
    public function prixLogementAction()
    {
        $dispo = $this->dispoLogementAction();

        if ($dispo === true) {
            $prix = 250;
            echo "$prix";
        } else {
            $nonDispo = "Non disponible";
            echo "$nonDispo";
        }
        return $this->render('CnccvHouseBundle:Default:index.html.twig', array(
            'dispo' => $dispo,));
    }

    /**
     * @Route (name="page")
     */
    public function pageDemarrageAction()
    {
        if (!isset($_POST['demandeCiblee'])) {
            $nbPersonne = 1;
            $dateArrivee = date('Y-m-d');
            $dateDepart = date('Y-m-d', strtotime('+2 day'));

            echo "Les tarifs ci-dessous sont valables du $dateArrivee au $dateDepart pour $nbPersonne personne(s)";


        } else {
            $nbPersonne = $_POST['nombre_personne'];
            $dateArrivee = $_POST['from'];
            $dateDepart = $_POST['to'];

            echo "Les tarifs ci-dessous sont valables du $dateArrivee au $dateDepart pour $nbPersonne personne(s)";
        }

        /**    for ($logement = 1; $logement; $logement++) {
         * ${'prix' . $logement} = $this->prixLogementAction($dateArrivee, $dateDepart, $nbPersonne, $logement);
         * }
         */
    }

    public function bookingAction()
    {
        $this->get('booker'); /** @var \Kami\BookingBundle\Helper\Booker */
    }
}