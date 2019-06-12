<?php

namespace SchedulingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ScheduleBreakController extends Controller
{
    /**
     * @Route("/break")
     */
    public function indexAction()
    {
        return $this->render('SchedulingBundle:ScheduleBreak:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/break/create")
     */
    public function createAction()
    {
        return $this->render('SchedulingBundle:ScheduleBreak:create.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/break/delete")
     */
    public function deleteAction()
    {
        return $this->render('SchedulingBundle:ScheduleBreak:delete.html.twig', array(
            // ...
        ));
    }

}
