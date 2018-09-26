<?php

namespace StaffingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="StaffingBundle\Repository\PositionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Position
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
     * @ORM\Column(name="jobCode", type="string", length=10)
     */
    private $jobCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="payLevel", type="integer")
     */
    private $payLevel;

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
     * Many employee have one position
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\Employee", mappedBy="position")
     */
    private $users;     
    
    /**
     * Many employee have one position
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\WorkForceAllocation", mappedBy="position")
     */
    private $workforceallocations;       
    
    
    public function __construct(){
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();      
        $this->workforceallocations = new \Doctrine\Common\Collections\ArrayCollection();            
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
     * Set jobCode
     *
     * @param string $jobCode
     *
     * @return Position
     */
    public function setJobCode($jobCode)
    {
        $this->jobCode = $jobCode;

        return $this;
    }

    /**
     * Get jobCode
     *
     * @return string
     */
    public function getJobCode()
    {
        return $this->jobCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Position
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
     * @return Position
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
     * Set payLevel
     *
     * @param integer $payLevel
     *
     * @return Position
     */
    public function setPayLevel($payLevel)
    {
        $this->payLevel = $payLevel;

        return $this;
    }

    /**
     * Get payLevel
     *
     * @return int
     */
    public function getPayLevel()
    {
        return $this->payLevel;
    }

    /**
     * Add user
     *
     * @param \StaffingBundle\Entity\Employee $user
     *
     * @return Position
     */
    public function addUser(\StaffingBundle\Entity\Employee $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \StaffingBundle\Entity\Employee $user
     */
    public function removeUser(\StaffingBundle\Entity\Employee $user)
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Position
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
     * @return Position
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
     * Add workforceallocation
     *
     * @param \StaffingBundle\Entity\WorkForceAllocation $workforceallocation
     *
     * @return Position
     */
    public function addWorkforceallocation(\StaffingBundle\Entity\WorkForceAllocation $workforceallocation)
    {
        $this->workforceallocations[] = $workforceallocation;

        return $this;
    }

    /**
     * Remove workforceallocation
     *
     * @param \StaffingBundle\Entity\WorkForceAllocation $workforceallocation
     */
    public function removeWorkforceallocation(\StaffingBundle\Entity\WorkForceAllocation $workforceallocation)
    {
        $this->workforceallocations->removeElement($workforceallocation);
    }

    /**
     * Get workforceallocations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkforceallocations()
    {
        return $this->workforceallocations;
    }
}
