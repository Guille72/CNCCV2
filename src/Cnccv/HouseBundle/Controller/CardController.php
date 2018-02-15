<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Cnccv\HouseBundle\Entity\Logement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{

    /**
     * Lists all logement entities.
     * @Route (name="cards")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logements = $em->getRepository('CnccvHouseBundle:Logement')->findAll();

        return $this->render('CnccvHouseBundle:Default:cards.html.twig', array(
            'logements' => $logements,
        ));
    }

    /**
     * Finds and displays a logement entity.
     *
     * @Route("/description/{id}", name="description_show")
     * @Method("GET")
     */
    public function showAction(Logement $logement)
    {
        $deleteForm = $this->createDeleteForm($logement);

        return $this->render('@CnccvHouseBundle/Default/description.html.twig', array(
            'logement' => $logement,
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
