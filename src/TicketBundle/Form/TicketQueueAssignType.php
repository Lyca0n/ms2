<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use TicketBundle\Entity\TicketQueue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
/**
 * Description of TicketQueueAssignType
 *
 * @author jvillalv
 */
class TicketQueueAssignType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users', EntityType::class, array('multiple'=> true, 'class' => 'AuthBundle\Entity\User', 'choice_label' => function ($user) {
            return $user->getUsername();
            },'attr' => array('class'=>'form-control multiselect')));           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TicketQueue::class,
        ));
    }
 
}
