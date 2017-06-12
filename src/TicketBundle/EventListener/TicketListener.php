<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TicketBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use TicketBundle\Entity\Ticket;

/**
 * Description of TicketListener
 *
 * @author jvillalv
 */
class TicketListener {

    private $mailer;
    private $twig;
    private $autoSetting;

    public function __construct($mailer, $twig, $autoSetting) {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->autoSetting = $autoSetting;
    }

    public function prePersist(LifecycleEventArgs $args) {
        
        $ticket = $args->getEntity();
        if ($ticket instanceof Ticket) {
            $manager = $args->getEntityManager();
            $queue = $ticket->getTicketQueue()->getName();
            if ($this->autoSetting == true) {
                $userRepo = $manager->getRepository('AuthBundle:User');
                $users= $userRepo->createQueryBuilder('u')
                        //->setMaxResults(1)
                        ->select('u')
                        ->join('u.employee', 'e')
                        ->join('u.ticketQueues', 'tq')
                        ->join('u.assignedTickets', 't')
                        ->where('tq.name = :queue')
                        ->orderBy('t.createdAt', 'DESC')
                        ->setParameter('queue', $queue)
                        ->getQuery()
                        ->execute();
                        //->getSingleResult();
                $user = $users[rand(0, sizeof($users))];
                $ticket->setAssignedTo($user);
                
                //$manager->persist($ticket);
                //$manager->flush();
            }
        }
    }

    public function postUpdate(LifecycleEventArgs $args) {
        
          $ticket = $args->getEntity();
          if( $ticket instanceof Ticket){
          $message = \Swift_Message::newInstance()
          ->setSubject('Ticket Status Update')
          ->setFrom('cs.operations.desk@autozone.com')
          ->setTo($ticket->getCreatedBy()->getEmail())
          ->setBody(
          $this->twig->render('TicketBundle:email:ticket_update.html.twig', array(
          'ticket' => $ticket)), 'text/html');
          $this->mailer->send($message);
          } 
    }

}
