<?php

namespace FRD\CarBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CarroType extends AbstractType
{
    private $entity;

    public function __construct($entity = null) {
        $this->entity = $entity;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modelo', 'text', ['label'=>'Modelo:', 'required'=>true])
            ->add('fabricante')
            ->add('ano')
            ->add('cor')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'FRD\CarBundle\Entity\Carro'
        ]);
    }

    public function getName()
    {
        return "frd_carsbundle_carrotype";
    }

}