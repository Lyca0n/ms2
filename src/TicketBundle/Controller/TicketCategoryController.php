<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TicketBundle\Entity\TicketCategory;
use TicketBundle\Form\TicketCategoryType;
use Symfony\Component\HttpFoundation\Request;

class TicketCategoryController extends Controller
{
    /**
     * @Route("/ticketcategory", name="ticketcategory")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('TicketBundle:TicketCategory')->findAll();                           
        return $this->render('TicketBundle:TicketCategory:index.html.twig', array(
            'categories' => $categories,  
        ));
    }

    /**
     * @Route("/ticketcategory/create", name="ticketcategory_create")
     */
    public function createAction(Request $request)
    {
        $category =  new TicketCategory();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(TicketCategoryType::class, $category);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketcategory'));
        }           
        return $this->render('TicketBundle:TicketCategory:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketcategory/edit/{id}" , name="ticketcategory_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();   
        $category =  $em->getRepository('TicketBundle:TicketCategory')->find($id);
        $form = $this->createForm(TicketCategoryType::class, $category);
        $form->handleRequest($request);   
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            
            return $this->redirect($this->generateUrl('ticketcategory'));
        }      
        return $this->render('TicketBundle:TicketCategory:edit.html.twig', array(
           'form' => $form->createView()
        ));
    }

    /**
     * @Route("/ticketcategory/delete/{id}" , name="ticketcategory_delete")
     */
    public function deleteAction($id)
    {
        return $this->render('TicketBundle:TicketCategory:delete.html.twig', array(
            // ...
        ));
    }

}
