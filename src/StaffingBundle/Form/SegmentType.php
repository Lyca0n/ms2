<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace StaffingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use StaffingBundle\Entity\Segment;

/**
 * Description of SegmentType
 *
 * @author jvillalv
 */
class SegmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('department', EntityType::class, array('multiple'=> false, 'class' => 'StaffingBundle\Entity\department', 'choice_label' => function ($dept) {
            return $dept->getName(); },'attr' => array('class'=>'form-control')));     
            /*->add('channel', EntityType::class, array('multiple'=> false, 'class' => 'StaffingBundle\Entity\Channel', 'choice_label' => function ($dept) {
            return $dept->getName(); },'attr' => array('class'=>'form-control')))
            ->add('s', EntityType::class, array('multiple'=> false, 'class' => 'StaffingBundle\Entity\ServiceUnit', 'choice_label' => function ($holder) {
            return $holder->getName(); },'attr' => array('class'=>'form-control')));*/            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Segment::class,
        ));
    }
}