<?php

namespace FRD\CarBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use FRD\CarBundle\Entity\EntityInterface;

class CarService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function insert(EntityInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        $msg = [
            'text'=>"Carro {$entity->getModelo()} inserido com sucesso",
            'type'=>'alert-success'
        ];

        return $msg;
    }

    public function update(EntityInterface $entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        $msg = [
            'text'=>"Carro {$entity->getModelo()} alterado com sucesso",
            'type'=>'alert-warning'
        ];

        return $msg;
    }

    public function delete(EntityInterface $entity)
    {
        $msg = [
            'text'=>"Carro {$entity->getModelo()} excluido com sucesso",
            'type'=>'alert-danger'
        ];

        $this->em->remove($entity);
        $this->em->flush();

        return $msg;
    }
}