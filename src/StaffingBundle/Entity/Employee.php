<?php

namespace StaffingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="StaffingBundle\Repository\EmployeeRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Assert\File(
     *     maxSize = "7M",
     *     mimeTypes = {"image/jpeg", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Please upload a valid image(.jped,.jpg,.png)",
     *     groups = {"create"}
     * )    
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $profilePicture;    

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max=40)
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
     * @Assert\NotBlank()
     * @Assert\Length(max=40)
     * @ORM\Column(name="lastName", type="string", length=40)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hireDate", type="datetime", nullable=false)
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
     * @ORM\OneToMany(targetEntity="StaffingBundle\Entity\Employee", mappedBy="supervisor")
     */
    private $subordinate;    
    
    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Department", inversedBy="employees") 
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id", nullable=true)
     **/
    private $department;    
    
    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Employee", inversedBy="subordinate") 
     * @ORM\JoinColumn(name="supervisor_id", referencedColumnName="id", nullable=true)
     **/
    private $supervisor;
    
    /**
     * @ORM\ManyToOne(targetEntity="StaffingBundle\Entity\Position", inversedBy="users") 
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     **/
    private $position;
    
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
     * @ORM\Column(name="is_active", type="boolean", options={"default" : 0})
     */
    private $isActive;    
    
    /**
     * @ORM\Column(name="isFulltime", type="boolean", options={"default" : 1})
     */
    private $isFulltime;        
    
    public function __construct() {
        $this->subordinate = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString() {
        return (string) $this->firstName.' '.$this->lastName;
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
     * @param \StaffingBundle\Entity\Employee $supervisor
     *
     * @return Employee
     */
    public function setSupervisor(\StaffingBundle\Entity\Employee $supervisor = null)
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return \StaffingBundle\Entity\Employee
     */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Add subordinate
     *
     * @param \StaffingBundle\Entity\Employee $subordinate
     *
     * @return Employee
     */
    public function addSubordinate(\StaffingBundle\Entity\Employee $subordinate)
    {
        $this->subordinate[] = $subordinate;

        return $this;
    }

    /**
     * Remove subordinate
     *
     * @param \StaffingBundle\Entity\Employee $subordinate
     */
    public function removeSubordinate(\StaffingBundle\Entity\Employee $subordinate)
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
     * @param \StaffingBundle\Entity\Position $position
     *
     * @return Employee
     */
    public function setPosition(\StaffingBundle\Entity\Position $position = null)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return \StaffingBundle\Entity\Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set profilePicture
     *
     * @param string $profilePicture
     *
     * @return Employee
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return string
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
    
    public function isActive()
    {
        return $this->isActive;
    }        
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
    
    
    public function getCreatedAt(){
        return $this->createdAt;
    }
    
    public function getUpdatedAt(){
        return $this->updatedAt;
    }
 
        

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Employee
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Employee
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isFulltime
     *
     * @param boolean $isFulltime
     *
     * @return Employee
     */
    public function setIsFulltime($isFulltime)
    {
        $this->isFulltime = $isFulltime;

        return $this;
    }

    /**
     * Get isFulltime
     *
     * @return boolean
     */
    public function getIsFulltime()
    {
        return $this->isFulltime;
    }
    

    /**
     * Set department
     *
     * @param \StaffingBundle\Entity\Department $department
     *
     * @return Employee
     */
    public function setDepartment(\StaffingBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get $department
     *
     * @return \StaffingBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }    
}
