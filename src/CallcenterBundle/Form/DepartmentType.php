<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CallcenterBundle\Form;
use Symfony\Component\Form\AbstractType;
use CallcenterBundle\Entity\Department;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of DepartmentType
 *
 * @author jvillalv
 */
class DepartmentType extends AbstractType {    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('costcenter', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\CostCenter', 'choice_label' => function ($center) {
            return $center->getCode().' '.$center->getName() ; },'attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Department::class,
        ));
    }
}
