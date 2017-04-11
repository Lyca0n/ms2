<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CallcenterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CallcenterBundle\Entity\WorkForceAllocation;

/**
 * Description of WorkForceAllocationType
 *
 * @author jvillalv
 */
class WorkForceAllocationType extends AbstractType {    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('segment', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\Segment', 'choice_label' => function ($seg) {
            return $seg->getName() ; },'attr' => array('class'=>'form-control')))
            ->add('position', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\Position', 'choice_label' => function ($pos) {
            return $pos->getName() ; },'attr' => array('class'=>'form-control'))) 
            ->add('allocation', NumberType::class, array('attr' => array('class'=>'form-control')));  
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => WorkForceAllocation::class,
        ));
    }
}
