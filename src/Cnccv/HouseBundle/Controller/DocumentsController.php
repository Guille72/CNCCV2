<?php

namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DocumentsController extends Controller
{
    /**
     * @Route("/documents", name="documents")
     */
    public function indexAction()
    {
        $url = $this->get('router')->generate('documents', array(), true);
        return $this->render('CnccvHouseBundle:Default:document.html.twig');
    }
}
