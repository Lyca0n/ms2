<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CostCenter
 *
 * @ORM\Table(name="cost_center")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\CostCenterRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CostCenter
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
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var string
     *
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
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     *
     * @var DateTime $updatedAt
     */
    protected $updatedAt;    
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\Department", mappedBy="costcenter")
     */
    private $departments;     
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\StakeHolder", mappedBy="costcenter")
     */
    private $stakeholders;    

    public  function __construct() {
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stakeholders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param integer $code
     *
     * @return CostCenter
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CostCenter
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
     * @return CostCenter
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
     * @return CostCenter
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
     * Add department
     *
     * @param \CallcenterBundle\Entity\Department $department
     *
     * @return CostCenter
     */
    public function addDepartment(\CallcenterBundle\Entity\Department $department)
    {
        $this->departments[] = $department;

        return $this;
    }

    /**
     * Remove department
     *
     * @param \CallcenterBundle\Entity\Department $department
     */
    public function removeDepartment(\CallcenterBundle\Entity\Department $department)
    {
        $this->departments->removeElement($department);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Add stakeholder
     *
     * @param \CallcenterBundle\Entity\StakeHolder $stakeholder
     *
     * @return CostCenter
     */
    public function addStakeholder(\CallcenterBundle\Entity\StakeHolder $stakeholder)
    {
        $this->stakeholders[] = $stakeholder;

        return $this;
    }

    /**
     * Remove stakeholder
     *
     * @param \CallcenterBundle\Entity\StakeHolder $stakeholder
     */
    public function removeStakeholder(\CallcenterBundle\Entity\StakeHolder $stakeholder)
    {
        $this->stakeholders->removeElement($stakeholder);
    }

    /**
     * Get stakeholders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStakeholders()
    {
        return $this->stakeholders;
    }
}
