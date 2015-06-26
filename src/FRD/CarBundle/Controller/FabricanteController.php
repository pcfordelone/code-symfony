<?php

namespace FRD\CarBundle\Controller;


use FRD\CarBundle\Entity\Fabricante;
use FRD\CarBundle\Form\FabricanteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/fabricantes")
 */
class FabricanteController extends Controller
{

    /**
     * @Route("/", name="fabricantes")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fabricantes = $em->getRepository("FRD\CarBundle\Entity\Fabricante")->findAll();

        return ['fabricantes' => $fabricantes];
    }

    /**
     * @Route("/new/", name="fabricante_new")
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
     * @Route("/create/", name="fabricante_create")
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

            return $this->redirect($this->generateUrl('fabricantes'));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/edit", name="fabricante_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Fabricante")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $form = $this->createForm(new FabricanteType(), $entity);

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/update/", name="fabricante_update")
     * @Template("FRDCarBundle:Fabricante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Fabricante")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fabricantes'));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/delete/", name="fabricante_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Fabricante")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('fabricantes'));
    }

}