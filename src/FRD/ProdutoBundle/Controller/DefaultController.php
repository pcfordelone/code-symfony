<?php

namespace FRD\ProdutoBundle\Controller;

use FRD\ProdutoBundle\Entity\Produto;
use FRD\ProdutoBundle\Entity\ProdutoCategoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FRD\ProdutoBundle\Entity\ProdutoDetalhe;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/doctrine")
     * @Template()
     */
    public function testeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoria1 = new ProdutoCategoria();
        $categoria1
            ->setName("Tenis")
            ->setDescription("Todos os tipos de tenis")
        ;
        $categoria2 = new ProdutoCategoria();
        $categoria2
            ->setName("Calçados")
            ->setDescription("Todos os tipos de calçados")
        ;

        $produto1 = new Produto();
        $produto1
            ->setName("Tenis Mizuno")
            ->setDescription("Descrição tenis Mizuno.")
        ;

        $produto1
            ->addCategoria($categoria1)
            ->addCategoria($categoria2)
        ;

        $em->persist($categoria1);
        $em->persist($categoria2);
        $em->persist($produto1);

        $em->flush();

        return [];
    }
}
