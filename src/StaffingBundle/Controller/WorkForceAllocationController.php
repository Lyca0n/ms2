<?php

namespace StaffingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StaffingBundle\Entity\WorkForceAllocation;
use StaffingBundle\Form\WorkForceAllocationType;
use Symfony\Component\HttpFoundation\Request;

class WorkForceAllocationController extends Controller
{    
    /**
     * @Route("/workforce", name="workforce")
     */
    public function createAction(Request $request)
    {
        $all =  new WorkForceAllocation();
        $em = $this->getDoctrine()->getManager();
        $alls = $em->getRepository('StaffingBundle:WorkForceAllocation')->findAll();  
        $form = $this->createForm(WorkForceAllocationType::class, $all);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($all);
            $em->flush();
            
            return $this->redirect($this->generateUrl('workforce'));
        }                
        return $this->render('StaffingBundle:workforceallocation:create.html.twig', array(
            'allocations' => $alls,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/workforce/delete/{id}", name="workforce_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ch = $em->getRepository('StaffingBundle:WorkForceAllocation')->find($id);
        $em->remove($ch);
        $em->flush();
        return $this->redirect($this->generateUrl('workforce'));   
    }
    /**
     * @Route("/workforce/edit/{id}", name="workforce_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository('StaffingBundle:WorkForceAllocation')->find($id);
        $form = $this->createForm(WorkForceAllocationType::class, $all);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($all);
            $em->flush();
            
            return $this->redirect($this->generateUrl('workforce'));
        }           
        return $this->render('StaffingBundle:workforceallocation:edit.html.twig', array(
            'form' => $form->createView()
        ));        
    }            

}
