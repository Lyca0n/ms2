<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Segment
 *
 * @ORM\Table(name="segment")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\SegmentRepository")
 */
class Segment
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
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Channel", inversedBy="segments") 
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     **/
    private $channel;    

    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\ServiceUnit", inversedBy="segments") 
     * @ORM\JoinColumn(name="serviceunit_id", referencedColumnName="id")
     **/
    private $serviceunit;    

    /**
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\WorkForceAllocation", mappedBy="segment")
     */
    private $workforceallocations;    
    
    public function __construct() {
        $this->workforceallocations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Segment
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
     * Set channel
     *
     * @param \CallcenterBundle\Entity\Channel $channel
     *
     * @return Segment
     */
    public function setChannel(\CallcenterBundle\Entity\Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \CallcenterBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set serviceunit
     *
     * @param \CallcenterBundle\Entity\Serviceunit $serviceunit
     *
     * @return Segment
     */
    public function setServiceunit(\CallcenterBundle\Entity\Serviceunit $serviceunit = null)
    {
        $this->serviceunit = $serviceunit;

        return $this;
    }

    /**
     * Get serviceunit
     *
     * @return \CallcenterBundle\Entity\Serviceunit
     */
    public function getServiceunit()
    {
        return $this->serviceunit;
    }

    /**
     * Set workforceallocations
     *
     * @param \CallcenterBundle\Entity\WorkForceAllocation $workforceallocations
     *
     * @return Segment
     */
    public function setWorkforceallocations(\CallcenterBundle\Entity\WorkForceAllocation $workforceallocations = null)
    {
        $this->workforceallocations = $workforceallocations;

        return $this;
    }

    /**
     * Get workforceallocations
     *
     * @return \CallcenterBundle\Entity\WorkForceAllocation
     */
    public function getWorkforceallocations()
    {
        return $this->workforceallocations;
    }

    /**
     * Add workforceallocation
     *
     * @param \CallcenterBundle\Entity\WorkForceAllocation $workforceallocation
     *
     * @return Segment
     */
    public function addWorkforceallocation(\CallcenterBundle\Entity\WorkForceAllocation $workforceallocation)
    {
        $this->workforceallocations[] = $workforceallocation;

        return $this;
    }

    /**
     * Remove workforceallocation
     *
     * @param \CallcenterBundle\Entity\WorkForceAllocation $workforceallocation
     */
    public function removeWorkforceallocation(\CallcenterBundle\Entity\WorkForceAllocation $workforceallocation)
    {
        $this->workforceallocations->removeElement($workforceallocation);
    }
}
