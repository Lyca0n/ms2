<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace StaffingBundle\Form;

use Symfony\Component\Form\AbstractType;
use StaffingBundle\Entity\Employee;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of EmployeeType
 *
 * @author jvillalv
 */
class EmployeeEditType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('firstname', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('middlename', TextType::class, array('attr' => array('class' => 'form-control'), 'required' => false))
                ->add('lastname', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('gender', ChoiceType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'choices'   => array('Male' => 'Male', 'Female' => 'Female', 'other' => 'other'),
                    'required'  => false,
                ))                
                ->add('isactive', ChoiceType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Is this Employee active?',
                    'choices' => array(
                        'Yes' => true,
                        'No' => false,
                    ),
                ))
                ->add('isfulltime', ChoiceType::class, array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Is this Employee full time?',
                    'choices' => array(
                        'Yes' => true,
                        'No' => false,
                    ),
                ))                  
                ->add('hiredate', DateType::class, array('attr' => array('class' => 'form-control'), 'years' => range(date('Y') - 18, date('Y') + 18)))
                ->add('supervisor', EntityType::class, array('multiple' => false, 'class' => 'StaffingBundle\Entity\Employee', 'required' => false, 'placeholder' => 'Choose an option', 'choice_label' => function ($employee) {
                        return $employee->getFirstName() . ' ' . $employee->getLastName();
                    }, 'attr' => array('class' => 'form-control')))
                ->add('position', EntityType::class, array('multiple' => false, 'class' => 'StaffingBundle\Entity\Position', 'choice_label' => function ($position) {
                        return $position->getJobCode() . ' ' . $position->getName();
                    }, 'attr' => array('class' => 'form-control')))
                ->add('department', EntityType::class, array('multiple'=> false, 'class' => 'StaffingBundle\Entity\department', 'choice_label' => function ($dept) {
                        return $dept->getName(); },'attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Employee::class,
        ));
    }

}
