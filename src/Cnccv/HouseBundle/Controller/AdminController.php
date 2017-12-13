<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        $url = $this->get('router')->generate('admin', true);
        return $this->render('CnccvHouseBundle:admin:dashboard.html.twig');
    }
}
