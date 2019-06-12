<?php

namespace SchedulingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TimeOffController extends Controller
{
    /**
     * @Route("/timeoff")
     */
    public function indexAction()
    {
        return $this->render('SchedulingBundle:TimeOff:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/timeoff/create")
     */
    public function createAction()
    {
        return $this->render('SchedulingBundle:TimeOff:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/timeoff/delete")
     */
    public function deleteAction()
    {
        return $this->render('SchedulingBundle:TimeOff:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/timeoff/review")
     */
    public function approveAction()
    {
        return $this->render('SchedulingBundle:TimeOff:approve.html.twig', array(
            // ...
        ));
    }

}
