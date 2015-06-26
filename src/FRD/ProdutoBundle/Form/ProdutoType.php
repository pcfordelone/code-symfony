<?php

namespace FRD\ProdutoBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class ProdutoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['label'=>'Produto:', 'required'=>true])
            ->add('description')
        ;
    }

    public function getName()
    {
        return "frd_produtobundle_produtotype";
    }
}