<?php

namespace SchedulingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Break
 *
 * @ORM\Table(name="break")
 * @ORM\Entity(repositoryClass="SchedulingBundle\Repository\BreakRepository")
 */
class Break
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
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="time")
     */
    private $endTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="paid", type="boolean")
     */
    private $paid;

     /**
     * 
     * @var ArrayCollection $schedules
     * @ORM\ManyToMany(targetEntity="SchedulingBundle\Entity\Schedule", mappedBy="breaks")
    */
    private $schedules;


    public function __construct() {
      
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Break
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Break
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return Break
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return bool
     */
    public function getPaid()
    {
        return $this->paid;
    }
}

