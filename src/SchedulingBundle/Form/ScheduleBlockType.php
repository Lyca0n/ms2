<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SchedulingBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use SchedulingBundle\Entity\Shift;

/**
 * Description of ShiftType
 *
 * @author jvillalv
 */
class ShiftType extends AbstractType {    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('startTime',  TimeType::class, array(
                'attr' => array('class'=>'form-control'),
                'placeholder' => array(
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )
            ))
            ->add('endTime',  TimeType::class, array(
                'attr' => array('class'=>'form-control'),
                'placeholder' => array(
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Shift::class,
        ));
    }
}
