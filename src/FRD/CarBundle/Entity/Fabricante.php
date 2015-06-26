<?php

namespace FRD\CarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Fabricante
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="Carro", mappedBy="fabricante")
     **/
    private $carros;

    public function __construct()
    {
        $this->carros = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNome();
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getCarros()
    {
        return $this->carros;
    }

    public function setCarros($carros)
    {
        $this->carros = $carros;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
}