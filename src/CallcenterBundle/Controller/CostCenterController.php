<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Entity\CostCenter;
use Symfony\Component\HttpFoundation\Request;
use CallcenterBundle\Form\CostCenterType;

class CostCenterController extends Controller
{
    /**
     * @Route("/costcenter", name="costcenter")
     */
    public function createAction(Request $request)
    {
        $center =  new CostCenter();
        $em = $this->getDoctrine()->getManager();
        $centers = $em->getRepository('CallcenterBundle:CostCenter')->findAll();
        $form = $this->createForm(CostCenterType::class, $center);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($center);
            $em->flush();
            
            return $this->redirect($this->generateUrl('costcenter'));
        }                
        return $this->render('CallcenterBundle:costcenter:create.html.twig', array(
            'centers' => $centers,
            'form' => $form->createView()
        ));    
    }

    /**
     * @Route("/costcenter/delete/{id}",name="costcenter_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $center = $em->getRepository('CallcenterBundle:CostCenter')->find($id);        
        $em->remove($center);
        $em->flush();
        return $this->redirect($this->generateUrl('costcenter'));          
    }

}
