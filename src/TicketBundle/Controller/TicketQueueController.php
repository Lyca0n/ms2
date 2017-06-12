<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Entity\TicketQueue;
use TicketBundle\Form\TicketQueueType;
use TicketBundle\Form\TicketQueueAssignType;

use Symfony\Component\HttpFoundation\Request;

class TicketQueueController extends Controller
{
    /**
     * @Route("/ticketqueue", name="ticketqueue")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $queues = $em->getRepository('TicketBundle:TicketQueue')->findAll();                   
        return $this->render('TicketBundle:TicketQueue:index.html.twig', array(
            'queues' => $queues,            
        ));        

    }

    /**
     * @Route("/ticketqueue/create", name="ticketqueue_create")
     */
    public function createAction(Request $request)
    {
        $queue =  new TicketQueue();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(TicketQueueType::class, $queue);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($queue);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketqueue'));
        }           
        return $this->render('TicketBundle:TicketQueue:create.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/ticketqueue/edit/{id}", name="ticketqueue_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $queue = $em->getRepository('TicketBundle:TicketQueue')->find($id);
        $form = $this->createForm(TicketQueueType::class, $queue);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($queue);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketqueue'));
        }                  
        return $this->render('TicketBundle:TicketQueue:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketqueue/delete/{id}", name="ticketqueue_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $q = $em->getRepository('TicketBundle:TicketQueue')->find($id);
        if($q){
            $em->remove($q);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('ticketqueue'));
    }
    /**
     * @Route("/ticketqueue/assign/{id}", name="ticketqueue_assign")
     */
    public function assignAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $queue = $em->getRepository('TicketBundle:TicketQueue')->find($id);  
        $form = $this->createForm(TicketQueueAssignType::class, $queue);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($queue);
            $em->flush();

            return $this->redirect($this->generateUrl('ticketqueue'));
        }                  
        return $this->render('TicketBundle:TicketQueue:assign.html.twig', array(
            'form' => $form->createView(),
            'queue' => $queue
        ));        
    }
}
