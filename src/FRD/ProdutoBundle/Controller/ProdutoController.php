<?php

namespace FRD\ProdutoBundle\Controller;


use FRD\ProdutoBundle\Entity\Produto;
use FRD\ProdutoBundle\Form\ProdutoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ProdutoController extends Controller
{
    /**
     * @Route("/produto")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository("FRDProdutoBundle:Produto");
        $produtos = $repo->findAll();

        return ['produtos'=>$produtos];
    }

    /**
     * @Route("/new_produto", name="new_produto")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Produto();
        $form = $this->createForm(new ProdutoType(), $entity);

        return [
            'entity' => $entity,
            'form'   => $form->createView()
        ];
    }
}