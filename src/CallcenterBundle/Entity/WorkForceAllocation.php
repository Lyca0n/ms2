<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkForceAllocation
 *
 * @ORM\Table(name="work_force_allocation")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\WorkForceAllocationRepository")
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
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Segment", inversedBy="workforceallocations") 
     * @ORM\JoinColumn(name="segment_id", referencedColumnName="id")
     **/
    private $segment;    
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Position", inversedBy="workforceallocations") 
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
     * @param \CallcenterBundle\Entity\Segment $segment
     *
     * @return WorkForceAllocation
     */
    public function setSegment(\CallcenterBundle\Entity\Segment $segment = null)
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * Get segment
     *
     * @return \CallcenterBundle\Entity\Segment
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Set position
     *
     * @param \CallcenterBundle\Entity\Postition $position
     *
     * @return WorkForceAllocation
     */
    public function setPosition(\CallcenterBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \CallcenterBundle\Entity\Postition
     */
    public function getPosition()
    {
        return $this->position;
    }
}
