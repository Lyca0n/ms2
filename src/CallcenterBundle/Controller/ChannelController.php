<?php

namespace CallcenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CallcenterBundle\Form\ChannelType;
use CallcenterBundle\Entity\Channel;
use Symfony\Component\HttpFoundation\Request;

class ChannelController extends Controller
{
    /**
     * @Route("/channel", name="channel")
     */
    public function createAction(Request $request)
    {      
        $channel =  new Channel();
        $em = $this->getDoctrine()->getManager();
        $channels = $em->getRepository('CallcenterBundle:Channel')->findAll();
        $form = $this->createForm(ChannelType::class, $channel);
        $form->handleRequest($request);         
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($channel);
            $em->flush();
            
            return $this->redirect($this->generateUrl('channel'));
        }                
        return $this->render('CallcenterBundle:channel:create.html.twig', array(
            'channels' => $channels,
            'form' => $form->createView()
        ));

    }
    /**
     * @Route("/channel/delete/{id}", name="channel_delete")
     */
    public function deleteAction($id)
    {       
        $em = $this->getDoctrine()->getManager();
        $ch = $em->getRepository('CallcenterBundle:Channel')->find($id);
        $em->remove($ch);
        $em->flush();
        return $this->redirect($this->generateUrl('channel'));             
    }

}
