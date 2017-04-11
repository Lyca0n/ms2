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
use CallcenterBundle\Entity\ServiceUnit;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of ServiceUnitType
 *
 * @author jvillalv
 */
class ServiceUnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('description', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('contact', TextType::class, array('attr' => array('class'=>'form-control')))                
            ->add('department', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\Department', 'choice_label' => function ($dept) {
            return $dept->getName(); },'attr' => array('class'=>'form-control')))
            ->add('stakeholder', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\StakeHolder', 'choice_label' => function ($holder) {
            return $holder->getName(); },'attr' => array('class'=>'form-control')));            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ServiceUnit::class,
        ));
    }
}
