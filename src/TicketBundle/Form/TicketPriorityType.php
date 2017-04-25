<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use TicketBundle\Entity\TicketPriority;
/**
 * Description of TicketPriorityType
 *
 * @author jvillalv
 */
class TicketPriorityType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', TextType::class, array('attr' =>
                    array('class' => 'form-control')))
                ->add('priorityvalue', IntegerType::class, array('attr' =>
                    array('class' => 'form-control')));
    }            
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => TicketPriority::class,
        ));
    }
}
