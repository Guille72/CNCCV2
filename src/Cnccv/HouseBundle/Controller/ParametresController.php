<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ParametresController extends Controller
{
    /**
     * @Route("/parametres", name="parametres")
     */
    public function indexAction()
    {
        $url = $this->get('router')->generate('parametres', array(), true);
        return $this->render('CnccvHouseBundle:Default:parametres.html.twig');
    }
}
