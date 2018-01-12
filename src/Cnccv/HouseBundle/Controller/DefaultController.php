<?php

namespace Cnccv\HouseBundle\Controller;

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

        return $this->render('CnccvHouseBundle:Default:index.html.twig', array('logements' => $logements));
    }
}