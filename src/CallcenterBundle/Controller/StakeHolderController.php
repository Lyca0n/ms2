<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Entity\StakeHolder;
use CallcenterBundle\Form\StakeHolderType;
use Symfony\Component\HttpFoundation\Request;

class StakeHolderController extends Controller
{
    /**
     * @Route("/stakeholder", name="stakeholder")
     */
    public function createAction(Request $request)
    {
        $holder =  new StakeHolder();
        $em = $this->getDoctrine()->getManager();
        $holders = $em->getRepository('CallcenterBundle:StakeHolder')->findAll();  
        $form = $this->createForm(StakeHolderType::class, $holder);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($holder);
            $em->flush();
            
            return $this->redirect($this->generateUrl('stakeholder'));
        }                
        return $this->render('CallcenterBundle:stakeholder:create.html.twig', array(
            'holders' => $holders,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/stakeholder/delete/{id}", name="stakeholder_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ch = $em->getRepository('CallcenterBundle:Channel')->find($id);
        $em->remove($ch);
        $em->flush();
        return $this->redirect($this->generateUrl('channel'));   
    }

    /**
     * @Route("/stakeholder/edit/{id}", name="stakeholder_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $holder = $em->getRepository('CallcenterBundle:StakeHolder')->find($id);  
        $form = $this->createForm(StakeHolderType::class, $holder);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($holder);
            $em->flush();
            
            return $this->redirect($this->generateUrl('stakeholder'));
        }                
        return $this->render('CallcenterBundle:stakeholder:edit.html.twig', array(            
            'form' => $form->createView()
        ));        

    }

}
