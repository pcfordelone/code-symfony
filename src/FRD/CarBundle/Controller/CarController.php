<?php

namespace FRD\CarBundle\Controller;

use FRD\CarBundle\Entity\Carro;
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
        $em = $this->getDoctrine()->getManager();
        $carros = $em->getRepository("FRD\CarBundle\Entity\Carro")->findAll();

        return ["carros" => $carros];
    }

    /**
     * @Route("/inserir_carros", name="insert_cars_index")
     * @Template()
     */
    public function insertCarsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $carro1 = new Carro();
        $carro1
            ->setFabricante("BMW")
            ->setModelo("X1")
            ->setAno("2015")
            ->setCor("Preta")
        ;
        $em->persist($carro1);

        $carro2 = new Carro();
        $carro2
            ->setFabricante("BMW")
            ->setModelo("X3")
            ->setAno("2015")
            ->setCor("Prata")
        ;
        $em->persist($carro2);

        $carro3 = new Carro();
        $carro3
            ->setFabricante("BMW")
            ->setModelo("X5")
            ->setAno("2015")
            ->setCor("Branca")
        ;
        $em->persist($carro3);

        $carro4 = new Carro();
        $carro4
            ->setFabricante("Ford")
            ->setModelo("Fusion")
            ->setAno("2015")
            ->setCor("Branca")
        ;
        $em->persist($carro4);

        $em->flush();

        return ["carros"=>[$carro1,$carro2,$carro3,$carro4]];
    }
}
