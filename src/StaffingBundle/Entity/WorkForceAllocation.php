<?php

namespace StaffingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkForceAllocation
 *
 * @ORM\Table(name="work_force_allocation")
 * @ORM\Entity(repositoryClass="StaffingBundle\Repository\WorkForceAllocationRepository")
 */
class WorkForceAllocation
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
     * @var int
     *
     * @ORM\Column(name="allocation", type="integer")
     */
    private $allocation;

    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Department", inversedBy="workforceallocations") 
     * @ORM\JoinColumn(name="segment_id", referencedColumnName="id")
     **/
    private $department;    
    
    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Position", inversedBy="workforceallocations") 
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     **/
    private $position;        
    
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
     * Set allocation
     *
     * @param integer $allocation
     *
     * @return WorkForceAllocation
     */
    public function setAllocation($allocation)
    {
        $this->allocation = $allocation;

        return $this;
    }

    /**
     * Get allocation
     *
     * @return int
     */
    public function getAllocation()
    {
        return $this->allocation;
    }


    /**
     * Set segment
     *
     * @param \StaffingBundle\Entity\Department $segment
     *
     * @return WorkForceAllocation
     */
    public function setDepartment(\StaffingBundle\Entity\Department $segment = null)
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * Get segment
     *
     * @return \StaffingBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->segment;
    }

    /**
     * Set position
     *
     * @param \StaffingBundle\Entity\Postition $position
     *
     * @return WorkForceAllocation
     */
    public function setPosition(\StaffingBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \StaffingBundle\Entity\Postition
     */
    public function getPosition()
    {
        return $this->position;
    }
}
