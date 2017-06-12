<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="TicketBundle\Repository\TicketRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ticket
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
     * @ORM\Column(name="title", type="string", length=25, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;
    
     /**
     * @ORM\ManyToOne(targetEntity="TicketBundle\Entity\TicketQueue", inversedBy="tickets") 
     * @ORM\JoinColumn(name="ticketqueue_id", referencedColumnName="id")
     **/
    private $ticketQueue; 
    
     /**
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User", inversedBy="createdTickets") 
     * @ORM\JoinColumn(name="createdby_id", referencedColumnName="id")
     **/
    private $createdBy; 
    
     /**
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User", inversedBy="assignedTickets") 
     * @ORM\JoinColumn(name="assignedto_id", referencedColumnName="id")
     **/
    private $assignedTo;     
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\TicketComment", mappedBy="ticket")
     */
    private $comments;   

     /**
     * @ORM\ManyToOne(targetEntity="TicketBundle\Entity\TicketStatus", inversedBy="tickets") 
     * @ORM\JoinColumn(name="ticketstatus_id", referencedColumnName="id")
     **/
    private $ticketStatus;     

     /**
     * @ORM\ManyToOne(targetEntity="TicketBundle\Entity\TicketPriority", inversedBy="tickets") 
     * @ORM\JoinColumn(name="ticketpriority_id", referencedColumnName="id")
     **/
    private $ticketPriority;     
    
     /**
     * @ORM\ManyToOne(targetEntity="TicketBundle\Entity\TicketCategory", inversedBy="tickets") 
     * @ORM\JoinColumn(name="ticketcategory_id", referencedColumnName="id")
     **/
    private $ticketCategory;     
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\TicketAttachment", mappedBy="ticket")
     */
    private $ticketAttachments;      
        
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }
        
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
     * Set title
     *
     * @param string $title
     *
     * @return Ticket
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ticket
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Ticket
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Ticket
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    } 


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ticketAttachments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set createdBy
     *
     * @param \AuthBundle\Entity\User $createdBy
     *
     * @return Ticket
     */
    public function setCreatedBy(\AuthBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AuthBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set assignedTo
     *
     * @param \AuthBundle\Entity\User $assignedTo
     *
     * @return Ticket
     */
    public function setAssignedTo(\AuthBundle\Entity\User $assignedTo = null)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return \AuthBundle\Entity\User
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Add comment
     *
     * @param \TicketBundle\Entity\TicketComment $comment
     *
     * @return Ticket
     */
    public function addComment(\TicketBundle\Entity\TicketComment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \TicketBundle\Entity\TicketComment $comment
     */
    public function removeComment(\TicketBundle\Entity\TicketComment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set ticketStatus
     *
     * @param \TicketBundle\Entity\TicketStatus $ticketStatus
     *
     * @return Ticket
     */
    public function setTicketStatus(\TicketBundle\Entity\TicketStatus $ticketStatus = null)
    {
        $this->ticketStatus = $ticketStatus;

        return $this;
    }

    /**
     * Get ticketStatus
     *
     * @return \TicketBundle\Entity\TicketStatus
     */
    public function getTicketStatus()
    {
        return $this->ticketStatus;
    }

    /**
     * Set ticketCategory
     *
     * @param \TicketBundle\Entity\TicketCategory $ticketCategory
     *
     * @return Ticket
     */
    public function setTicketCategory(\TicketBundle\Entity\TicketCategory $ticketCategory = null)
    {
        $this->ticketCategory = $ticketCategory;

        return $this;
    }

    /**
     * Get ticketCategory
     *
     * @return \TicketBundle\Entity\TicketCategory
     */
    public function getTicketCategory()
    {
        return $this->ticketCategory;
    }

    /**
     * Add ticketAttachment
     *
     * @param \TicketBundle\Entity\TicketAttachment $ticketAttachment
     *
     * @return Ticket
     */
    public function addTicketAttachment(\TicketBundle\Entity\TicketAttachment $ticketAttachment)
    {
        $this->ticketAttachments[] = $ticketAttachment;

        return $this;
    }

    /**
     * Remove ticketAttachment
     *
     * @param \TicketBundle\Entity\TicketAttachment $ticketAttachment
     */
    public function removeTicketAttachment(\TicketBundle\Entity\TicketAttachment $ticketAttachment)
    {
        $this->ticketAttachments->removeElement($ticketAttachment);
    }

    /**
     * Get ticketAttachments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketAttachments()
    {
        return $this->ticketAttachments;
    }

    /**
     * Set ticketQueue
     *
     * @param \TicketBundle\Entity\TicketQueue $ticketQueue
     *
     * @return Ticket
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
     * Set ticketPriority
     *
     * @param \TicketBundle\Entity\TicketPriority $ticketPriority
     *
     * @return Ticket
     */
    public function setTicketPriority(\TicketBundle\Entity\TicketPriority $ticketPriority = null)
    {
        $this->ticketPriority = $ticketPriority;

        return $this;
    }

    /**
     * Get ticketPriority
     *
     * @return \TicketBundle\Entity\TicketPriority
     */
    public function getTicketPriority()
    {
        return $this->ticketPriority;
    }
}
