<?php

namespace FRD\ProdutoBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ProdutoRepository extends EntityRepository
{
    public function findIdMaiorQue($num)
    {
        $dql = "SELECT p FROM FRDProdutoBundle:Produto p WHERE p.id > :num";

        return $this
                ->getEntityManager()
                ->createQuery($dql)
                ->setParameter(":num", $num)
                ->getResult()
        ;
    }
}