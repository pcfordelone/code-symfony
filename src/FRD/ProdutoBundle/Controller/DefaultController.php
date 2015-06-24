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

        /*$categoria = new ProdutoCategoria();
        $categoria
            ->setName("Tenis")
            ->setDescription("Todos os tipos de tenis")
        ;

        $produtoDetalhe = new ProdutoDetalhe();
        $produtoDetalhe
            ->setAltura(10)
            ->setLargura(15)
            ->setPeso(1)
        ;

        $produto = new Produto();
        $produto
            ->setName("Tenis Mizuno")
            ->setDescription("Descrição tenis Mizuno.")
        ;

        $produto
            ->setDetail($produtoDetalhe)
            ->setCategory($categoria)
        ;

        $em->persist($categoria);
        $em->persist($produtoDetalhe);
        $em->persist($produto);

        $em->flush();

        $repo = $em->getRepository("FRD\ProdutoBundle\Entity\Produto");
        $produtos = $repo->findAll();
        //$produtos = $repo->findIdMaiorQue(5);*/

        $repo = $em->getRepository("FRD\ProdutoBundle\Entity\ProdutoCategoria");
        $categoria = $repo->find(1);


        return ['categoria'=>$categoria];
    }
}
