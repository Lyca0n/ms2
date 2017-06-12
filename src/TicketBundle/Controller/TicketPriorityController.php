<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Entity\TicketPriority;
use TicketBundle\Form\TicketPriorityType;
use Symfony\Component\HttpFoundation\Request;

class TicketPriorityController extends Controller
{
    /**
     * @Route("/ticketpriority", name="ticketpriority")
     */
    public function createAction(Request $request)
    {
        $priority =  new TicketPriority();
        $em = $this->getDoctrine()->getManager();
        $priorities = $em->getRepository('TicketBundle:TicketPriority')->findAll();
        $form = $this->createForm(TicketPriorityType::class, $priority);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($priority);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketpriority'));
        }                  
        return $this->render('TicketBundle:TicketPriority:create.html.twig', array(
            'priorities' => $priorities,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketstatus/edit/{id}", name="ticketpriority_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $priority = $em->getRepository('TicketBundle:TicketPriority')->find($id);
        $form = $this->createForm(TicketPriorityType::class, $priority);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($priority);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketpriority'));
        }                                     
        
        return $this->render('TicketBundle:TicketPriority:edit.html.twig', array(
           'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketstatus/delete/{id}", name="ticketpriority_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $priority = $em->getRepository('TicketBundle:TicketPriority')->find($id);
        if($priority){
            $em->remove($priority);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('ticketpriority'));
    }
}
