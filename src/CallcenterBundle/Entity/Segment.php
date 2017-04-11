<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Segment
 *
 * @ORM\Table(name="segment")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\SegmentRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("name")
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
     * @Assert\NotBlank()
     * @Assert\Length(max=25)
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Segment
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
     * @return Segment
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
     * Set serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     *
     * @return Segment
     */
    public function setServiceunit(\CallcenterBundle\Entity\ServiceUnit $serviceunit = null)
    {
        $this->serviceunit = $serviceunit;

        return $this;
    }

    /**
     * Get serviceunit
     *
     * @return \CallcenterBundle\Entity\ServiceUnit
     */
    public function getServiceunit()
    {
        return $this->serviceunit;
    }
}
