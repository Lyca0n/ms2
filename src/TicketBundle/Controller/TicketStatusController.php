<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Form\TicketStatusType;
use TicketBundle\Entity\TicketStatus;
use Symfony\Component\HttpFoundation\Request;

class TicketStatusController extends Controller
{
    /**
     * @Route("/ticketstatus", name="ticketstatus")
     */
    public function createAction(Request $request)
    {
        $status =  new TicketStatus();
        $em = $this->getDoctrine()->getManager();
        $statuslist = $em->getRepository('TicketBundle:TicketStatus')->findAll();
        $form = $this->createForm(TicketStatusType::class, $status);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($status);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketstatus'));
        }                  
        return $this->render('TicketBundle:TicketStatus:create.html.twig', array(
            'statuslist' => $statuslist,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketstatus/edit/{id}", name="ticketstatus_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('TicketBundle:TicketStatus')->find($id);
        $form = $this->createForm(TicketStatusType::class, $status);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($status);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketstatus'));
        }                          
        
        return $this->render('TicketBundle:TicketStatus:edit.html.twig', array(
           'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketstatus/delete/{id}", name="ticketstatus_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $status = $em->getRepository('TicketBundle:TicketStatus')->find($id);
        if($status){
            $em->remove($status);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('ticketstatus'));
    }

}
