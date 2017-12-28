<?php
namespace Cnccv\HouseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homePage" )
     */
    public function indexAction()
    {
        return $this->render('CnccvHouseBundle:Default:index.html.twig');
    }
}
