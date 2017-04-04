<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Entity\Position;
use Symfony\Component\HttpFoundation\Request;
use CallcenterBundle\Form\PositionType;

class PositionController extends Controller
{
    /**
     * @Route("/position", name="position")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $positions = $em->getRepository('CallcenterBundle:Position')->findAll();
        return $this->render('CallcenterBundle:position:index.html.twig', array(
            'positions' => $positions
        ));
    }

    /**
     * @Route("/position/create", name="position_create")
     */
    public function createAction(Request $request)
    {
        $pos = new Position();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(PositionType::class, $pos);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pos);
            $em->flush();
            
            return $this->redirect($this->generateUrl('position'));
        }        

        return $this->render('CallcenterBundle:position:create.html.twig', array(
           'form' => $form->createView()
        ));
    }

    /**
     * @Route("/position/edit/{id}", name="position_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $pos =  $em->getRepository('CallcenterBundle:Position')->find($id);
        $form = $this->createForm(PositionType::class, $pos);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pos);
            $em->flush();
            
            return $this->redirect($this->generateUrl('position'));
        }        

        return $this->render('CallcenterBundle:position:create.html.twig', array(
           'form' => $form->createView()
        ));        
        
    }    
    
    /**
     * @Route("/position/delete/{id}", name="position_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $position = $em->getRepository('CallcenterBundle:Position')->find($id);
        $em->remove($position);
        $em->flush();
        return $this->redirect($this->generateUrl('position'));     
    }    

}
