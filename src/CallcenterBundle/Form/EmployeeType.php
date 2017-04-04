<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace CallcenterBundle\Form;
use Symfony\Component\Form\AbstractType;
use CallcenterBundle\Entity\Employee;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
/**
 * Description of EmployeeType
 *
 * @author jvillalv
 */
class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mexid', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('ignitionid', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('firstname', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('middlename', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('lastname', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('hiredate', DateType::class, array('attr' => array('class'=>'form-control')))
            ->add('supervisor', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\Employee', 'choice_label' => function ($employee) {
            return $employee->getFirstName().' '.$employee->getLastName() ; },'attr' => array('class'=>'form-control')))
            ->add('position', EntityType::class, array('multiple'=> false, 'class' => 'CallcenterBundle\Entity\Position', 'choice_label' => function ($position) {
            return $position->getJobCode().' '.$position->getName() ; },'attr' => array('class'=>'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Employee::class,
        ));
    }
}
