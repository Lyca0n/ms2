<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Entity\Ticket;
use TicketBundle\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;

class TicketController extends Controller
{
    /**
     * @Route("/ticket", name="ticket")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository('TicketBundle:Ticket')->findAll();                             
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
            
            $em->persist($ticket);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticket'));
        }                   
        return $this->render('TicketBundle:Ticket:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticket/edit", name="ticket_edit")
     */
    public function editAction()
    {
        return $this->render('TicketBundle:Ticket:edit.html.twig', array(
            // ...
        ));
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
