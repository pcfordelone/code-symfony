<?php

namespace FRD\CarBundle\Controller;


use FRD\CarBundle\Entity\Fabricante;
use FRD\CarBundle\Form\FabricanteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class FabricanteController extends Controller
{

    /**
     * @Route("/fabricantes", name="fabricantes_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fabricantes = $em->getRepository("FRD\CarBundle\Entity\Fabricante")->findAll();

        return ['fabricantes' => $fabricantes];
    }

    /**
     * @Route("/new_fabricante", name="new_fabricante")
     * @Template()
     */
    public function addFabricanteAction()
    {
        $entity = new Fabricante();
        $form = $this->createForm(new FabricanteType(), $entity);

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/create_fabricante", name="create_fabricante")
     * @Template("FRDCarBundle:Fabricante:addFabricante.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fabricante();

        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fabricantes_index'));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }


}