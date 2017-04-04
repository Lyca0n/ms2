<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CallcenterBundle\Form;
use Symfony\Component\Form\AbstractType;
use CallcenterBundle\Entity\CostCenter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Description of CostCenterType
 *
 * @author jvillalv
 */
class CostCenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CostCenter::class,
        ));
    }
}