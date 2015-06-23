<?php

namespace FRD\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CarController extends Controller
{
    /**
     * @Route("/", name="cars_index")
     * @Template()
     */
    public function indexAction()
    {
        $carros = [
            ['marca'=>'BMW', 'modelo'=>'X1'],
            ['marca'=>'BMW', 'modelo'=>'X3'],
            ['marca'=>'BMW', 'modelo'=>'X5'],
            ['marca'=>'Ford', 'modelo'=>'Focus'],
            ['marca'=>'Ford', 'modelo'=>'Fusion'],
            ['marca'=>'Ford', 'modelo'=>'Fiesta'],
            ['marca'=>'Volkswagen', 'modelo'=>'Gol'],
            ['marca'=>'Volkswagen', 'modelo'=>'Voyage'],
            ['marca'=>'Volkswagen', 'modelo'=>'Jetta'],
            ['marca'=>'Volkswagen', 'modelo'=>'Passat'],
        ];

        return ['carros' => $carros];
    }
}
