<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace StaffingBundle\Form;
use Symfony\Component\Form\AbstractType;
use StaffingBundle\Entity\Position;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
/**
 * Description of PositionType
 *
 * @author jvillalv
 */
class PositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jobcode', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('description', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('paylevel', NumberType::class, array('attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => position::class,
        ));
    }
}
