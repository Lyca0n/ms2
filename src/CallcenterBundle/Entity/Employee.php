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
     * @ORM\OneToOne(targetEntity="AuthBundle\Entity\User", inversedBy="employee")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */    

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
}

