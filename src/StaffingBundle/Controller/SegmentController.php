<?php

namespace StaffingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StaffingBundle\Entity\Segment;
use StaffingBundle\Form\SegmentType;
use Symfony\Component\HttpFoundation\Request;

class SegmentController extends Controller
{

    /**
     * @Route("/segment", name="segment")
     */
    public function createAction(Request $request)
    {
        $segment = new Segment();
        $em = $this->getDoctrine()->getManager();
        $segments = $em->getRepository('StaffingBundle:Segment')->findAll();        
        $form = $this->createForm(SegmentType::class, $segment);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($segment);
            $em->flush();            
            return $this->redirect($this->generateUrl('segment'));
        }        
       
        return $this->render('StaffingBundle:segment:create.html.twig', array(
            'segments' => $segments,
            'form' => $form->createView()
        ));
    }

    
    /**
     * @Route("/segment/delete/{id}", name="segment_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $segment = $em->getRepository('StaffingBundle:Segment')->find($id);
        $em->remove($segment);
        $em->flush();
        return $this->redirect($this->generateUrl('segment'));   
    }

    /**
     * @Route("/segment/edit/{id}", name="segment_edit")
     */
    public function editAction(Request $request, $id)
    {
        $form = $this->createForm(SegmentType::class, $segment);
        $form->handleRequest($request);   
        return $this->render('StaffingBundle:segment:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
