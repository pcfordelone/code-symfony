<?php

namespace FRD\CarBundle\Controller;

use FRD\CarBundle\Entity\Carro;
use FRD\CarBundle\Form\CarroType;
use FRD\CarBundle\Service\CarService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;


class CarController extends Controller
{

    /**
     * @Route("/", name="carros")
     * @Template()
     */
    public function indexAction(Request $request = null)
    {
        $em = $this->getDoctrine()->getManager();
        $carros = $em->getRepository("FRD\CarBundle\Entity\Carro")->findAll();


        return [
            "carros" => $carros,
        ];
    }

    /**
     * @Route("/insert", name="carro_insert")
     * @Template()
     */
    public function insertCarsAction()
    {
        $this->checkAuth();

        $entity = new Carro();
        $form = $this->createForm(new CarroType(), $entity);

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/create/", name="carro_create")
     * @Template("FRDCarBundle:Carro:insertCars.html.twig")
     */
    public function createAction(Request $request)
    {
        $this->checkAuth();

        $entity = new Carro();

        $form = $this->createForm(new CarroType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $carService = $this->get("frd_car.service.produto");
            $carService->insert($entity);

            return $this->redirect($this->generateUrl('carros'));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/edit", name="carro_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $this->checkAuth();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Carro")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $form = $this->createForm(new CarroType(), $entity);

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/update/", name="carro_update")
     * @Template("FRDCarBundle:Carro:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $this->checkAuth();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Carro")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $form = $this->createForm(new CarroType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $carService = $this->get("frd_car.service.produto");
            $msg = $carService->update($entity);

            return $this->redirect($this->generateUrl('carros',['msg'=>$msg]));
        }

        return [
            'entity' => $entity,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/{id}/delete/", name="carro_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $this->checkAuth();

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("FRDCarBundle:Carro")->find($id);

        if(!$entity) {
            throw $this->createNotFoundException("Registro não encontrado");
        }

        $carService = $this->get("frd_car.service.produto");
        $msg = $carService->delete($entity);

        return $this->redirect($this->generateUrl('carros',['msg'=>$msg]));
    }

    private function checkAuth()
    {
        $securityContext = $this->get('security.context');

        if (!$securityContext->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("Somente administradores tem acesso");
        }
    }
}
