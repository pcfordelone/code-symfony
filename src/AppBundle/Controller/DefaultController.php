<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/run/{carro}/{modelo}", name="projeto01")
     */
    public function runAction($carro, $modelo)
    {
        return $this->render('AppBundle:Default:projeto01.html.twig', ['carro'=>$carro, 'modelo'=>$modelo]);
    }
}
