<?php

namespace FRD\ProdutoBundle\Controller;

use FRD\ProdutoBundle\Entity\Produto;
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
        $produto = new Produto();
        $produto
            ->setName("Tenis Mizuno")
            ->setDescription("Descrição tenis Mizuno.")
        ;

        $produtoDetalhe = new ProdutoDetalhe();
        $produtoDetalhe
            ->setAltura(10)
            ->setLargura(15)
            ->setPeso(1)
        ;

        $produto->setDetail($produtoDetalhe);

        $em = $this->getDoctrine()->getManager();
        $em->persist($produtoDetalhe);
        $em->persist($produto);
        $em->flush();

        $repo = $em->getRepository("FRD\ProdutoBundle\Entity\Produto");
        $produtos = $repo->findAll();
        //$produtos = $repo->findIdMaiorQue(5);


        return ['produtos'=>$produtos];
    }
}
