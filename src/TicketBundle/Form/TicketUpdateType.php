<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use TicketBundle\Entity\Ticket;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TicketBundle\Form\EventListener\AddQueueFieldSubscriber;

/**
 * Description of TicketUpdateType
 *
 * @author jvillalv
 */
class TicketUpdateType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                //unable to pass in the selected value because of annonymous  func
                //->addEventSubscriber(new AddQueueFieldSubscriber())                
                ->addEventSubscriber(new AddQueueFieldSubscriber())                
                
                ->add('ticketstatus', EntityType::class, array('multiple' => false,
                    'class' => 'TicketBundle\Entity\TicketStatus', 'placeholder' => 'Select Status','label' => "Ticket Status", 'choice_label' => function
                    ($q) {
                        return $q->getName();
                    }, 'attr' => array('class' => 'form-control')));               
    }


    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }
}
