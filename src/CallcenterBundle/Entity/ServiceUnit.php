<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiceUnit
 *
 * @ORM\Table(name="service_unit")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\ServiceUnitRepository")
 */
class ServiceUnit
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=true)
     */
    private $contact;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\Employee", mappedBy="serviceunit")
     */
    private $employees;    

    /**
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\Segment", mappedBy="serviceunit")
     */
    private $segments;   
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Department", inversedBy="serviceunits") 
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     **/
    private $department;    
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\StakeHolder", inversedBy="serviceunits") 
     * @ORM\JoinColumn(name="stakeholder_id", referencedColumnName="id")
     **/
    private $stakeholder;        
    

    public  function __construct() {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->segments = new \Doctrine\Common\Collections\ArrayCollection();        
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
     * @return ServiceUnit
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
     * @return ServiceUnit
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
     * Set contact
     *
     * @param string $contact
     *
     * @return ServiceUnit
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add employee
     *
     * @param \CallcenterBundle\Entity\Employee $employee
     *
     * @return ServiceUnit
     */
    public function addEmployee(\CallcenterBundle\Entity\Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param \CallcenterBundle\Entity\Employee $employee
     */
    public function removeEmployee(\CallcenterBundle\Entity\Employee $employee)
    {
        $this->employees->removeElement($employee);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Set department
     *
     * @param \CallcenterBundle\Entity\Department $department
     *
     * @return ServiceUnit
     */
    public function setDepartment(\CallcenterBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \CallcenterBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set stakeholder
     *
     * @param \CallcenterBundle\Entity\StakeHolder $stakeholder
     *
     * @return ServiceUnit
     */
    public function setStakeholder(\CallcenterBundle\Entity\StakeHolder $stakeholder = null)
    {
        $this->stakeholder = $stakeholder;

        return $this;
    }

    /**
     * Get stakeholder
     *
     * @return \CallcenterBundle\Entity\CostCenter
     */
    public function getStakeholder()
    {
        return $this->stakeholder;
    }

    /**
     * Add segment
     *
     * @param \CallcenterBundle\Entity\Segment $segment
     *
     * @return ServiceUnit
     */
    public function addSegment(\CallcenterBundle\Entity\Segment $segment)
    {
        $this->segments[] = $segment;

        return $this;
    }

    /**
     * Remove segment
     *
     * @param \CallcenterBundle\Entity\Segment $segment
     */
    public function removeSegment(\CallcenterBundle\Entity\Segment $segment)
    {
        $this->segments->removeElement($segment);
    }

    /**
     * Get segments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSegments()
    {
        return $this->segments;
    }
}
