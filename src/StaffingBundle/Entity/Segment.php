<?php

namespace StaffingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Segment
 *
 * @ORM\Table(name="segment")
 * @ORM\Entity(repositoryClass="StaffingBundle\Repository\SegmentRepository")
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
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;


    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Department", inversedBy="segments") 
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     **/
    private $department;    
    
        
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
     * Set segment
     *
     * @param \StaffingBundle\Entity\Department 
     *
     * @return WorkForceAllocation
     */
    public function setDepartment(\StaffingBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get segment
     *
     * @return \StaffingBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }    

}
