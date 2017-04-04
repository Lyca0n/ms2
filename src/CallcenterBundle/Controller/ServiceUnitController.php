<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ServiceUnitController extends Controller
{
    /**
     * @Route("/unit", name="unit")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('CallcenterBundle:ServiceUnit')->findAll();        
        return $this->render('CallcenterBundle:serviceunit:index.html.twig', array(
            'units' =>$units
        ));
    }

    /**
     * @Route("/unit/create", name="unit_create")
     */
    public function createAction()
    {
        return $this->render('CallcenterBundle:serviceunit:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/unit/delete", name="unit_delete")
     */
    public function deleteAction()
    {
        return $this->render('CallcenterBundle:serviceunit:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/unit/edit/{id}", name="unit_edit")
     */
    public function editAction($id)
    {
        return $this->render('CallcenterBundle:serviceunit:edit.html.twig', array(
            // ...
        ));
    }

}
