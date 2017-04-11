<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Entity\Segment;
use CallcenterBundle\Form\SegmentType;
use Symfony\Component\HttpFoundation\Request;

class SegmentController extends Controller
{
    /**
     * @Route("/segment", name="segment")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $segments = $em->getRepository('CallcenterBundle:Segment')->findAll();        
        return $this->render('CallcenterBundle:segment:index.html.twig', array(
            'segments' =>$segments
        ));
    }

    /**
     * @Route("/segment/create", name="segment_create")
     */
    public function createAction(Request $request)
    {
        $segment = new Segment();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(SegmentType::class, $segment);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($segment);
            $em->flush();            
            return $this->redirect($this->generateUrl('segment'));
        }        
       
        return $this->render('CallcenterBundle:segment:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    
    /**
     * @Route("/segment/delete/{id}", name="segment_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $segment = $em->getRepository('CallcenterBundle:Segment')->find($id);
        $em->remove($segment);
        $em->flush();
        return $this->redirect($this->generateUrl('segment'));   
    }

    /**
     * @Route("/segment/edit/{id}", name="segment_edit")
     */
    public function editAction(Request $request, $id)
    {
        return $this->render('CallcenterBundle:segment:edit.html.twig', array(
            // ...
        ));
    }

}
