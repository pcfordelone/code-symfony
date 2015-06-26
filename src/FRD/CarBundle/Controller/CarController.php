<?php

namespace FRD\CarBundle\Controller;

use FRD\CarBundle\Entity\Carro;
use FRD\CarBundle\Entity\Fabricante;
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
     * @Route("/fabricantes/{id}", name="fabricantes_index")
     * @Template()
     */
    public function fabricanteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $fabricante = $em->getRepository("FRD\CarBundle\Entity\Fabricante")->find($id);

        return ["fabricante" => $fabricante];
    }

    /**
     * @Route("/inserir_carros", name="insert_cars_index")
     * @Template()
     */
    public function insertCarsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fabricante01 = new Fabricante();
        $fabricante01->setNome("BMW");
        $em->persist($fabricante01);

        $fabricante02 = new Fabricante();
        $fabricante02->setNome("Ford");
        $em->persist($fabricante02);

        $fabricante03 = new Fabricante();
        $fabricante03->setNome("Volkswagen");
        $em->persist($fabricante03);

        $carro1 = new Carro();
        $carro1
            ->setFabricante($fabricante01)
            ->setModelo("X1")
            ->setAno("2015")
            ->setCor("Preta")
        ;
        $em->persist($carro1);

        $carro2 = new Carro();
        $carro2
            ->setFabricante($fabricante01)
            ->setModelo("X3")
            ->setAno("2015")
            ->setCor("Prata")
        ;
        $em->persist($carro2);

        $carro3 = new Carro();
        $carro3
            ->setFabricante($fabricante02)
            ->setModelo("Focus")
            ->setAno("2015")
            ->setCor("Branca")
        ;
        $em->persist($carro3);

        $carro4 = new Carro();
        $carro4
            ->setFabricante($fabricante03)
            ->setModelo("Jetta")
            ->setAno("2015")
            ->setCor("Branca")
        ;
        $em->persist($carro4);

        $em->flush();

        return ["carros"=>[$carro1,$carro2,$carro3,$carro4]];
    }
}
