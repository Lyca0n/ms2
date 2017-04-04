<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\DepartmentRepository")
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
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\CostCenter", inversedBy="departments") 
     * @ORM\JoinColumn(name="costcenter_id", referencedColumnName="id")
     **/
    private $costcenter;       
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\ServiceUnit", mappedBy="department")
     */
    private $serviceunits;      
    
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
    public function __construct()
    {
        $this->serviceunits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set costcenter
     *
     * @param \CallcenterBundle\Entity\CostCenter $costcenter
     *
     * @return Department
     */
    public function setCostcenter(\CallcenterBundle\Entity\CostCenter $costcenter = null)
    {
        $this->costcenter = $costcenter;

        return $this;
    }

    /**
     * Get costcenter
     *
     * @return \CallcenterBundle\Entity\CostCenter
     */
    public function getCostcenter()
    {
        return $this->costcenter;
    }

    /**
     * Add serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     *
     * @return Department
     */
    public function addServiceunit(\CallcenterBundle\Entity\ServiceUnit $serviceunit)
    {
        $this->serviceunits[] = $serviceunit;

        return $this;
    }

    /**
     * Remove serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     */
    public function removeServiceunit(\CallcenterBundle\Entity\ServiceUnit $serviceunit)
    {
        $this->serviceunits->removeElement($serviceunit);
    }

    /**
     * Get serviceunits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServiceunits()
    {
        return $this->serviceunits;
    }
}
