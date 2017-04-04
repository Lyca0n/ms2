<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\EmployeeRepository")
 */
class Employee
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
     * @ORM\Column(name="mexId", type="string", length=6, unique=true)
     */
    private $mexId;

    /**
     * @var string
     *
     * @ORM\Column(name="ignitionId", type="string", length=8, unique=true)
     */
    private $ignitionId;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=40)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="middleName", type="string", length=40, nullable=true)
     */
    private $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=40)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hireDate", type="datetime", nullable=true)
     */
    private $hireDate;
    
    /**
     * to implement requires refractor deletion to set status to active
     * @var int
     *
     * @ORM\Column(name="active", type="integer", length=1)
     
    private $active;    */

    /**
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\User", inversedBy="employee")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */    
    private $user;
    
    /**
     * Many Employees have one supervisor
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\Employee", mappedBy="supervisor")
     */
    private $subordinate;    
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Employee", inversedBy="subordinate") 
     * @ORM\JoinColumn(name="supervisor_id", referencedColumnName="id")
     **/
    private $supervisor;
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\Position", inversedBy="users") 
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     **/
    private $position;
    
    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\ServiceUnit", inversedBy="employees") 
     * @ORM\JoinColumn(name="serviceunit_id", referencedColumnName="id")
     **/
    private $serviceunit;    
    
    public function __construct() {
        $this->subordinate = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return (string) $this->firstName.' '.$this->lastName;
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
     * Set mexId
     *
     * @param string $mexId
     *
     * @return Employee
     */
    public function setMexId($mexId)
    {
        $this->mexId = $mexId;

        return $this;
    }

    /**
     * Get mexId
     *
     * @return string
     */
    public function getMexId()
    {
        return $this->mexId;
    }

    /**
     * Set ignitionId
     *
     * @param string $ignitionId
     *
     * @return Employee
     */
    public function setIgnitionId($ignitionId)
    {
        $this->ignitionId = $ignitionId;

        return $this;
    }

    /**
     * Get ignitionId
     *
     * @return string
     */
    public function getIgnitionId()
    {
        return $this->ignitionId;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     *
     * @return Employee
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set hireDate
     *
     * @param \DateTime $hireDate
     *
     * @return Employee
     */
    public function setHireDate($hireDate)
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    /**
     * Get hireDate
     *
     * @return \DateTime
     */
    public function getHireDate()
    {
        return $this->hireDate;
    }

    /**
     * Set user
     *
     * @param \AuthBundle\Entity\User $user
     *
     * @return Employee
     */
    public function setUser(\AuthBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AuthBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set supervisor
     *
     * @param \CallcenterBundle\Entity\Employee $supervisor
     *
     * @return Employee
     */
    public function setSupervisor(\CallcenterBundle\Entity\Employee $supervisor = null)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return \CallcenterBundle\Entity\Employee
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Add subordinate
     *
     * @param \CallcenterBundle\Entity\Employee $subordinate
     *
     * @return Employee
     */
    public function addSubordinate(\CallcenterBundle\Entity\Employee $subordinate)
    {
        $this->subordinate[] = $subordinate;

        return $this;
    }

    /**
     * Remove subordinate
     *
     * @param \CallcenterBundle\Entity\Employee $subordinate
     */
    public function removeSubordinate(\CallcenterBundle\Entity\Employee $subordinate)
    {
        $this->subordinate->removeElement($subordinate);
    }

    /**
     * Get subordinate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubordinate()
    {
        return $this->subordinate;
    }

    /**
     * Set position
     *
     * @param \CallcenterBundle\Entity\Position $position
     *
     * @return Employee
     */
    public function setPosition(\CallcenterBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \CallcenterBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     *
     * @return Employee
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
