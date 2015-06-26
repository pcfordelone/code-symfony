<?php

namespace FRD\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class FabricanteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', 'text', ['label'=>'Fabricante:', 'required'=>true])
            ->add('descricao', 'textarea', [])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'FRD\CarBundle\Entity\Fabricante'
        ]);
    }

    public function getName()
    {
        return "frd_carsbundle_fabricantetype";
    }

}