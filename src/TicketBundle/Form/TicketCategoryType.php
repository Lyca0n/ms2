<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\Form;
use Symfony\Component\Form\AbstractType;
use TicketBundle\Entity\TicketCategory;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Description of TicketCategoryType
 *
 * @author jvillalv
 */
class TicketCategoryType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => array('class'=>'form-control')))            
            ->add('ticketqueue', EntityType::class, array('multiple' => false, 'class' => 'TicketBundle\Entity\TicketQueue', 'choice_label' => function ($q) {
                    return $q->getName();
                }, 'attr' => array('class' => 'form-control')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TicketCategory::class,
        ));
    }
}
