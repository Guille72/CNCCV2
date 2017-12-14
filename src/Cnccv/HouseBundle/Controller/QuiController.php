<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QuiController extends Controller
{
    /**
     * @Route("/qui", name="qui")
     */
    public function indexAction()
    {
        $url = $this->get('router')->generate('qui', array(), true);
        return $this->render('CnccvHouseBundle:Default:qui.html.twig');
    }
}
