<?php

namespace SchedulingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeOff
 *
 * @ORM\Table(name="time_off")
 * @ORM\Entity(repositoryClass="SchedulingBundle\Repository\TimeOffRepository")
 */
class TimeOff
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
     * @ORM\Column(name="startDateTime", type="datetime")
     */
    private $startDateTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDateTime", type="datetime")
     */
    private $endDateTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="paid", type="boolean")
     */
    private $paid;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="timeOffType", type="object")
     */
    private $timeOffType;


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
     * Set startDateTime
     *
     * @param \DateTime $startDateTime
     *
     * @return TimeOff
     */
    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    /**
     * Get startDateTime
     *
     * @return \DateTime
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * Set endDateTime
     *
     * @param \DateTime $endDateTime
     *
     * @return TimeOff
     */
    public function setEndDateTime($endDateTime)
    {
        $this->endDateTime = $endDateTime;

        return $this;
    }

    /**
     * Get endDateTime
     *
     * @return \DateTime
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return TimeOff
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

    /**
     * Set timeOffType
     *
     * @param \stdClass $timeOffType
     *
     * @return TimeOff
     */
    public function setTimeOffType($timeOffType)
    {
        $this->timeOffType = $timeOffType;

        return $this;
    }

    /**
     * Get timeOffType
     *
     * @return \stdClass
     */
    public function getTimeOffType()
    {
        return $this->timeOffType;
    }
}

