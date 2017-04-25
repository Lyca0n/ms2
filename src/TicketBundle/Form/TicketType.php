<?php

namespace TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TicketBundle\Entity\Ticket;
use Symfony\Component\Form\FormInterface;
use TicketBundle\Entity\TicketQueue;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class TicketType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::class, array('attr' =>
                    array('class' => 'form-control')))
                ->add('description', TextareaType::class, array('attr' =>
                    array('class' => 'form-control')))
                ->add('ticketqueue', EntityType::class, array('multiple' => false,
                    'class' => 'TicketBundle\Entity\TicketQueue', 'placeholder' => 'Select Queue', 'choice_label' => function
                    ($q) {
                        return $q->getName();
                    }, 'attr' => array('class' => 'form-control')));

        $formModifier = function (FormInterface $form, TicketQueue $sport = null) {
            $positions = null === $sport ? array() : $sport->getTicketCategories();

            $form->add('ticketcategory', EntityType::class, array(
                'class'       => 'TicketBundle\Entity\TicketCategory',
                'placeholder' => 'Select Category',
                'choices'     => $positions,
                'choice_label' => function($q) {
                        return $q->getName();
                    },    
                'attr' => array('class' => 'form-control')                            
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getTicketQueue());
            }
        );

        $builder->get('ticketqueue')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $sport = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $sport);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
        ));
    }

}
