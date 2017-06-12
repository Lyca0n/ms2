<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Entity\Ticket;
use TicketBundle\Form\TicketType;
use TicketBundle\Form\TicketCommentType;
use TicketBundle\Form\TicketUpdateType;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository('TicketBundle:Ticket')->findBy(array(),array('createdAt' => 'DESC'));                             
        return $this->render('TicketBundle:Ticket:index.html.twig', array(
            'tickets' => $tickets, 
        ));
    }

    /**
     * @Route("/ticket/create", name="ticket_create")
     */
    public function createAction(Request $request)
    {
        $ticket =  new Ticket();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setCreatedBy($this->get('security.token_storage')->getToken()->getUser());
            $em->persist($ticket);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticket'));
        }                   
        return $this->render('TicketBundle:Ticket:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticket/work/{id}", name="ticket_work")
     */
    public function workAction(Request $request, $id)
    {
        //call entitymanager from container
        $em = $this->getDoctrine()->getManager();
        $comment =  new \TicketBundle\Entity\TicketComment;        
        //find selected ticket
        $ticket = $em->getRepository('TicketBundle:Ticket')->find($id);
        //create update and comment forms
        $form = $this->createForm(TicketCommentType::class, $comment);
        $updateform = $this->createForm(TicketUpdateType::class, $ticket,[ 'action'=> $this->generateUrl('ticket_update',['id'=>$id])]);
        
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setTicket($ticket);
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('ticket_work',['id' => $id]));
        }
        return $this->render('TicketBundle:Ticket:work.html.twig', array(
            'ticket' => $ticket,
            'form' => $form->createView(),
            'updateform' => $updateform->createView()    
        ));
    }
    
    /**
     * @Route("/ticket/update/{id}", name="ticket_update")
     */
    public function updateAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $ticket = $em->getRepository('TicketBundle:Ticket')->find($id);
        $form = $this->createForm(TicketUpdateType::class, $ticket);
                
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ticket);
            $em->flush();
            return $this->redirect($this->generateUrl('ticket_work',['id' => $id]));
        }
    }

    /**
     * @Route("/ticket/close" , name="ticket_close")
     */
    public function closeAction()
    {
        return $this->render('TicketBundle:Ticket:close.html.twig', array(
            // ...
        ));
    }

}
