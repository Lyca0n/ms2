<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PriorityController extends Controller
{
    /**
     * @Route("/ticketpriority")
     */
    public function createAction()
    {
        return $this->render('TicketBundle:Priority:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/ticketpriority/edit/{id}")
     */
    public function editAction($id)
    {
        return $this->render('TicketBundle:Priority:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/ticketpriority/delete/{id}")
     */
    public function deleteAction($id)
    {
        return $this->render('TicketBundle:Priority:delete.html.twig', array(
            // ...
        ));
    }

}
