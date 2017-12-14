<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResaController extends Controller
{
    /**
     * @Route("/resa", name="resa")
     */
    public function indexAction()
    {
        $url = $this->get('router')->generate('resa', array(), true);
        return $this->render('CnccvHouseBundle:Default:reservations.html.twig');
    }
}
