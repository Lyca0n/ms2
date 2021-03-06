<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Description of User
 *
 * @author jvillalv
 */

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AuthBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=25)
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;
    
    /**
     * 
     * @Assert\Length(max=28)
     * @Assert\Length(min=8)
     */
    private $plainPassword;
    
    /** 
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     *
     * @var DateTime $updatedAt
     */
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="datetime", name="last_login_at", nullable=true)
     *
     * @var DateTime $lastLoginAt
     */
    protected $lastLoginAt;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", length=180, unique=true, options={"default" : "default.png"})
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean", options={"default" : 0})
     */
    private $isActive;
    
    /**
     * @var ArrayCollection $userRoles
     * 
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $userRoles;
    
    /**
     * @ORM\OneToOne(targetEntity="StaffingBundle\Entity\Employee", mappedBy="user")
     */
    private $employee;
    
    /**
     * 
     * @var ArrayCollection $users
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\Ticket", mappedBy="createdBy")
    */
    protected $createdTickets;

    /**
     * 
     * @var ArrayCollection $users
     * @ORM\OneToMany(targetEntity="TicketBundle\Entity\Ticket", mappedBy="assignedTo")
    */
    protected $assignedTickets;
    
    /**
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\UserGroup", inversedBy="users")
     * @ORM\JoinColumn(name="usergroup_id", referencedColumnName="id")
     */
    protected $userGroup;

    /**
     * @var ArrayCollection $users
     * @ORM\ManyToMany(targetEntity="TicketBundle\Entity\TicketQueue", mappedBy="users")
     */    
    protected $ticketQueues;



    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->ticketQueues = new ArrayCollection();
    }
    
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
    
    public function setEmployee($id){
        $this->employee = $id;
    }
    
    public function getEmployee(){
        return $this->employee;
    }
    
    public function setLastLoginAt(){
        $this->lastLoginAt = new \DateTime('now');
    }
    
    public function getLastLoginAt(){
        return $this->lastLoginAt;
    }
    
    public function getCreatedAt(){
        return $this->createdAt;
    }
    
    public function getUpdatedAt(){
        return $this->updatedAt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    
    public function getSalt()
    {
        
        return null;
    }    

    public function isActive()
    {
        return $this->isActive;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getplainPassword()
    {
        return $this->plainPassword;
    }

    public function getRoles()
    {
        return $this->getUserRoles()->toArray();
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return string
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    /**
     * Add userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     *
     * @return User
     */
    public function addUserRole(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Remove userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     */
    public function removeUserRole(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles->removeElement($userRole);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    

    /**
     * Add createdTicket
     *
     * @param \TicketBundle\Entity\Ticket $createdTicket
     *
     * @return User
     */
    public function addCreatedTicket(\TicketBundle\Entity\Ticket $createdTicket)
    {
        $this->createdTickets[] = $createdTicket;

        return $this;
    }

    /**
     * Remove createdTicket
     *
     * @param \TicketBundle\Entity\Ticket $createdTicket
     */
    public function removeCreatedTicket(\TicketBundle\Entity\Ticket $createdTicket)
    {
        $this->createdTickets->removeElement($createdTicket);
    }

    /**
     * Get createdTickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedTickets()
    {
        return $this->createdTickets;
    }

    /**
     * Add assignedTicket
     *
     * @param \TicketBundle\Entity\Ticket $assignedTicket
     *
     * @return User
     */
    public function addAssignedTicket(\TicketBundle\Entity\Ticket $assignedTicket)
    {
        $this->assignedTickets[] = $assignedTicket;

        return $this;
    }

    /**
     * Remove assignedTicket
     *
     * @param \TicketBundle\Entity\Ticket $assignedTicket
     */
    public function removeAssignedTicket(\TicketBundle\Entity\Ticket $assignedTicket)
    {
        $this->assignedTickets->removeElement($assignedTicket);
    }

    /**
     * Get assignedTickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssignedTickets()
    {
        return $this->assignedTickets;
    }

    /**
     * Set userGroup
     *
     * @param \AuthBundle\Entity\UserGroup $userGroup
     *
     * @return User
     */
    public function setUserGroup(\AuthBundle\Entity\UserGroup $userGroup = null)
    {
        $this->userGroup = $userGroup;

        return $this;
    }

    /**
     * Get userGroup
     *
     * @return \AuthBundle\Entity\UserGroup
     */
    public function getUserGroup()
    {
        return $this->userGroup;
    }


    /**
     * Add ticketQueue
     *
     * @param \TicketBundle\Entity\TicketQueue $ticketQueue
     *
     * @return User
     */
    public function addTicketQueue(\TicketBundle\Entity\TicketQueue $ticketQueue)
    {
        $this->ticketQueues[] = $ticketQueue;

        return $this;
    }

    /**
     * Remove ticketQueue
     *
     * @param \TicketBundle\Entity\TicketQueue $ticketQueue
     */
    public function removeTicketQueue(\TicketBundle\Entity\TicketQueue $ticketQueue)
    {
        $this->ticketQueues->removeElement($ticketQueue);
    }

    /**
     * Get ticketQueues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicketQueues()
    {
        return $this->ticketQueues;
    }
}
