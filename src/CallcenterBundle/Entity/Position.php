<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\PositionRepository")
 */
class Position
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
     * @ORM\Column(name="jobCode", type="string", length=10)
     */
    private $jobCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="payLevel", type="integer")
     */
    private $payLevel;


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
     * Set jobCode
     *
     * @param string $jobCode
     *
     * @return Position
     */
    public function setJobCode($jobCode)
    {
        $this->jobCode = $jobCode;

        return $this;
    }

    /**
     * Get jobCode
     *
     * @return string
     */
    public function getJobCode()
    {
        return $this->jobCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Position
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
     * @return Position
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
     * Set payLevel
     *
     * @param integer $payLevel
     *
     * @return Position
     */
    public function setPayLevel($payLevel)
    {
        $this->payLevel = $payLevel;

        return $this;
    }

    /**
     * Get payLevel
     *
     * @return int
     */
    public function getPayLevel()
    {
        return $this->payLevel;
    }
}

