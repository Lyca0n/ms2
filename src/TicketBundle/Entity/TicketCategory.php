<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketCategory
 *
 * @ORM\Table(name="ticket_category")
 * @ORM\Entity(repositoryClass="TicketBundle\Repository\TicketCategoryRepository")
 */
class TicketCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25)
     */
    private $name;

     /**
     * @ORM\ManyToOne(targetEntity="TicketBundle\Entity\TicketQueue", inversedBy="ticketCategories") 
     * @ORM\JoinColumn(name="ticketcategory_id", referencedColumnName="id")
     **/
    private $ticketQueue;     
    
    /**     
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\Ticket", mappedBy="ticketCategory")
     */

    private $tickets;    
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TicketCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ticketQueue
     *
     * @param \TicketBundle\Entity\TicketQueue $ticketQueue
     *
     * @return TicketCategory
     */
    public function setTicketQueue(\TicketBundle\Entity\TicketQueue $ticketQueue = null)
    {
        $this->ticketQueue = $ticketQueue;

        return $this;
    }

    /**
     * Get ticketQueue
     *
     * @return \TicketBundle\Entity\TicketQueue
     */
    public function getTicketQueue()
    {
        return $this->ticketQueue;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \TicketBundle\Entity\Ticket $ticket
     *
     * @return TicketCategory
     */
    public function addTicket(\TicketBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \TicketBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\TicketBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
