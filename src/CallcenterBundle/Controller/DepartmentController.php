<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Entity\Department;
use Symfony\Component\HttpFoundation\Request;
use CallcenterBundle\Form\DepartmentType;


class DepartmentController extends Controller
{
    /**
     * @Route("/department", name="department")
     */
    public function createAction(Request $request)
    {
        $dept =  new Department();
        $em = $this->getDoctrine()->getManager();
        $depts = $em->getRepository('CallcenterBundle:Department')->findAll();
        $form = $this->createForm(DepartmentType::class, $dept);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dept);
            $em->flush();
            
            return $this->redirect($this->generateUrl('department'));
        }                
        return $this->render('CallcenterBundle:Department:create.html.twig', array(
            'depts' => $depts,
            'form' => $form->createView()
        ));          
    }

    /**
     * @Route("/department/delete/{id}", name="department_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $dept = $em->getRepository('CallcenterBundle:Department')->find($id);        
        $em->remove($dept);
        $em->flush();
        return $this->redirect($this->generateUrl('department'));      
    }

}
