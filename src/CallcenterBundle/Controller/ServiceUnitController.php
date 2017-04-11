<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use CallcenterBundle\Form\ServiceUnitType;
use CallcenterBundle\Entity\ServiceUnit;

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
    public function createAction(Request $request)
    {
        $unit = new ServiceUnit();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ServiceUnitType::class, $unit);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($unit);
            $em->flush();            
            return $this->redirect($this->generateUrl('unit'));
        }        
   
        return $this->render('CallcenterBundle:serviceunit:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/unit/delete/{id}", name="unit_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $unit = $em->getRepository('CallcenterBundle:ServiceUnit')->find($id);
        $em->remove($unit);
        $em->flush();
        return $this->redirect($this->generateUrl('unit'));            
    }

    /**
     * @Route("/unit/edit/{id}", name="unit_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $unit = $em->getRepository('CallcenterBundle:ServiceUnit')->find($id);
        $form = $this->createForm(ServiceUnitType::class, $unit);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($unit);
            $em->flush();            
            return $this->redirect($this->generateUrl('unit'));
        }             
        return $this->render('CallcenterBundle:serviceunit:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
