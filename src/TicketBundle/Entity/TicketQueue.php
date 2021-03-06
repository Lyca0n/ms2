<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketQueue
 *
 * @ORM\Table(name="ticket_queue")
 * @ORM\Entity(repositoryClass="TicketBundle\Repository\TicketQueueRepository")
 */
class TicketQueue
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**     
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\Ticket", mappedBy="ticketQueue")
     */

    private $tickets;
    
    /**
     * @var ArrayCollection $ticketQueues
     * 
     * @ORM\ManyToMany(targetEntity="AuthBundle\Entity\User", inversedBy="ticketQueues")
     * @ORM\JoinTable(name="user_ticketqueue",
     *     joinColumns={@ORM\JoinColumn(name="ticket_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */    
    private $users;

    /**     
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\TicketCategory", mappedBy="ticketQueue")
     */

    private $ticketCategories;    

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
     * @return TicketQueue
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
     * Set description
     *
     * @param string $description
     *
     * @return TicketQueue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ticketCategories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \TicketBundle\Entity\Ticket $ticket
     *
     * @return TicketQueue
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



    /**
     * Add ticketCategory
     *
     * @param \TicketBundle\Entity\TicketCategory $ticketCategory
     *
     * @return TicketQueue
     */
    public function addTicketCategory(\TicketBundle\Entity\TicketCategory $ticketCategory)
    {
        $this->ticketCategories[] = $ticketCategory;

        return $this;
    }

    /**
     * Remove ticketCategory
     *
     * @param \TicketBundle\Entity\TicketCategory $ticketCategory
     */
    public function removeTicketCategory(\TicketBundle\Entity\TicketCategory $ticketCategory)
    {
        $this->ticketCategories->removeElement($ticketCategory);
    }

    /**
     * Get ticketCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketCategories()
    {
        return $this->ticketCategories;
    }

    /**
     * Add user
     *
     * @param \AuthBundle\Entity\User $user
     *
     * @return TicketQueue
     */
    public function addUser(\AuthBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AuthBundle\Entity\User $user
     */
    public function removeUser(\AuthBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
