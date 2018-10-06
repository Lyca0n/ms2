<?php

namespace SchedulingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use SchedulingBundle\Entity\ScheduleBlock;
use SchedulingBundle\Form\ScheduleBlockType;

class ScheduleBlockController extends Controller
{
    /**
     * @Route("scheduleblock/", name="scheduleblock")
     */
    public function indexAction()
    {
        return $this->render('SchedulingBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("scheduleblock/create", name="scheduleblock_create")
     */
    public function createAction(Request $request){
        
        $role = new ScheduleBlock();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ScheduleBlockType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($role);
            $em->flush();
            
            return $this->redirect($this->generateUrl('scheduleblock'));
        }
        
        return $this->render(
            'SchedulingBundle:scheduleblock:create.html.twig', array('form' => $form->createView())
        );        
    }    
}
