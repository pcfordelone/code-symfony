<?php

namespace FRD\ProdutoBundle\Controller;

use FRD\ProdutoBundle\Entity\Produto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        $produto = new Produto();
        $produto
            ->setName("Tenis Adidas")
            ->setDescription("Descrição tenis Adidas.")
        ;

        $em = $this->getDoctrine()->getManager();
        $em->persist($produto);
        $em->flush();

        $repo = $em->getRepository("FRD\ProdutoBundle\Entity\Produto");
        $produtos = $repo->findIdMenorQue(5);

        return ['produtos'=>$produtos];
    }
}
