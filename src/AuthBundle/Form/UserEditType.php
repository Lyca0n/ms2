<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\Form;

use AuthBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Description of UserEditType
 *
 * @author jvillalv
 */
class UserEditType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userRoles', EntityType::class, array('multiple'=> true, 'class' => 'AuthBundle\Entity\Role', 'choice_label' => 'slug','attr' => array('class'=>'form-control')))    
            ->add('email', EmailType::class, array('attr' => array('class'=>'form-control')))
            ->add('username', TextType::class, array('attr' => array('class'=>'form-control')))
            ->add('active', CheckboxType::class, array('attr' => array('class'=>'checkbox')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
    //put your code here
}
