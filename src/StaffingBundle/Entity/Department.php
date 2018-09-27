<?php

namespace StaffingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity(repositoryClass="StaffingBundle\Repository\DepartmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Department
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
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;
    
    /**
     * Many allocations have one department
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\WorkForceAllocation", mappedBy="department")
     */
    private $workforceallocations;     
    
    /**
     * Many segment have one department
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\Segment", mappedBy="department")
     */
    private $segments;     

    /**
     * Many employees have one department
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\Employee", mappedBy="department")
     */
    private $employees;         
    
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
     * Constructor
     */
    public function __construct(){
        $this->workforceallocations = new \Doctrine\Common\Collections\ArrayCollection();            
        $this->segments = new \Doctrine\Common\Collections\ArrayCollection();            
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();            
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
     * Set name
     *
     * @param string $name
     *
     * @return Department
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Department
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
     * @return Department
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
     * Add Segments
     *
     * @param \StaffingBundle\Entity\Segment $segment
     *
     * @return Position
     */
    public function addSegments(\StaffingBundle\Entity\Segment $segment)
    {
        $this->segments[] = $segment;

        return $this;
    }


    /**
     * Remove Segments
     *
     * @param \StaffingBundle\Entity\Segment $segment
     */
    public function removeSegments(\StaffingBundle\Entity\Segment $segment)
    {
        $this->segments->removeElement($segment);
    }

    /**
     * Add employees
     *
     * @param \StaffingBundle\Entity\Employee $employee
     *
     * @return Position
     */
    public function addEmployees(\StaffingBundle\Entity\Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }


    /**
     * Remove employees
     *
     * @param \StaffingBundle\Entity\Employee $employee
     */
    public function removeEmployees(\StaffingBundle\Entity\Employee $employee)
    {
        $this->employees->removeElement($employee);
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

}
