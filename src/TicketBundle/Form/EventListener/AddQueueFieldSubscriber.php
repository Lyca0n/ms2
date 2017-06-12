<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AuthBundle\Repository\UserRepository;
use TicketBundle\Entity\Ticket;

/**
 * Description of AddQueueFieldSubscriber
 *
 * @author jvillalv
 */
class AddQueueFieldSubscriber implements EventSubscriberInterface{
        
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }
    

    public function preSetData(FormEvent $event)
    {
        $ticket = $event->getData();
        $form = $event->getForm();
        $queue = $event->getData()->getTicketQueue()->getName();
        
        //if ($ticket) {
            $form->add('assignedto', EntityType::class, array('multiple' => false,
                    'class' => 'AuthBundle\Entity\User', 'placeholder' => 'Select Personel', 
                        'query_builder' => function (UserRepository $er) use ($queue) {
                            return $er->createQueryBuilder('u')
                            ->select('u') 
                            ->join('u.employee','e')
                            ->join('u.ticketQueues','tq')   
                            ->where('tq.name = :queue')        
                            ->orderBy('u.username', 'ASC')
                            ->setParameter('queue', $queue);        
                        },
                    'label' => "Assigned To:",
                    'choice_label' => function
                    ($q) {
                        return $q->getEmployee()->getFirstName()." ".$q->getEmployee()->getLastName();
                    }, 'attr' => array('class' => 'form-control')));  
        //}
    }    
}
