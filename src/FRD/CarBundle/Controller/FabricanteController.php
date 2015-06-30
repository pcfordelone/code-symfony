<?php

namespace FRD\CarBundle\Controller;


use FRD\CarBundle\Entity\Fabricante;
use FRD\CarBundle\Form\FabricanteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/fabricantes", name="fabricantes_index")
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
        $this->checkAuth();

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
        $this->checkAuth();

        $entity = new Fabricante();

        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $service = $this->get("frd_car.service.fabricante");
            $msg = $service->insert($entity);

            return $this->redirect($this->generateUrl('fabricantes',['msg'=>$msg]));
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
        $this->checkAuth();

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
        $this->checkAuth();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Fabricante")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $service = $this->get("frd_car.service.fabricante");
            $msg = $service->update($entity);

            return $this->redirect($this->generateUrl('fabricantes', ['msg'=>$msg]));
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
        $this->checkAuth();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Fabricante")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $service = $this->get("frd_car.service.fabricante");
        $msg = $service->delete($entity);

        return $this->redirect($this->generateUrl('fabricantes', ['msg'=>$msg]));
    }

    private function checkAuth()
    {
        $securityContext = $this->get('security.context');

        if (!$securityContext->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Somente administradores tem acesso");
        }
    }

}