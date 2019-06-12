<?php

namespace SchedulingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule")
 * @ORM\Entity(repositoryClass="SchedulingBundle\Repository\ScheduleRepository")
 */
class Schedule
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
     * @var ArrayCollection $schedules
     * 
     * @ORM\ManyToMany(targetEntity="SchedulingBundle\Entity\ScheduleBreak", inversedBy="schedules")
     * @ORM\JoinTable(name="schedule_break",
     *     joinColumns={@ORM\JoinColumn(name="schedule_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="break_id", referencedColumnName="id")}
     * )
     */
    private $breaks;

     /**
     * 
     * @var ArrayCollection $shifts
     * @ORM\ManyToMany(targetEntity="SchedulingBundle\Entity\Shift", mappedBy="schedules")
    */
    private $shifts;

    public function __construct() {
        $this->shifts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->breaks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Schedule
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
     * @return Schedule
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
     * Set breaks
     *
     * @param \stdClass $breaks
     *
     * @return Schedule
     */
    public function setBreaks($breaks)
    {
        $this->breaks = $breaks;

        return $this;
    }

    /**
     * Get breaks
     *
     * @return \stdClass
     */
    public function getBreaks()
    {
        return $this->breaks;
    }
}

