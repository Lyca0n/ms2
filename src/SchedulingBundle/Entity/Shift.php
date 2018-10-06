<?php

namespace SchedulingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Shift
 *
 * @ORM\Table(name="shift")
 * @ORM\Entity(repositoryClass="SchedulingBundle\Repository\ShiftRepository")
 */
class Shift
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
     * @ORM\Column(name="shiftHours", type="integer")
     */
    private $shiftHours;

    /**
     * @var string
     * @Assert\Choice({"Monday","Tuesday","Wednesday","Thursday","Friday","Saturday", "Sunday"})
     * @ORM\Column(name="workDays", type="string", length=255)
     */
    private $workDays;

    /**
     * @var string
     * @Assert\Choice({"Monday","Tuesday","Wednesday","Thursday","Friday","Saturday", "Sunday"})
     * @ORM\Column(name="offDays", type="string", length=255)
     */
    private $offDays;

    /**
     * @var int
     *
     * @ORM\Column(name="shiftDays", type="integer")
     */
    private $shiftDays;

    /**
     * @var ArrayCollection $schedules
     * 
     * @ORM\ManyToMany(targetEntity="SchedulingBundle\Entity\Schedules", inversedBy="shifts")
     * @ORM\JoinTable(name="shift_schedule",
     *     joinColumns={@ORM\JoinColumn(name="shift_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="schedule_id", referencedColumnName="id")}
     * )
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
     * Set shiftHours
     *
     * @param integer $shiftHours
     *
     * @return Shift
     */
    public function setShiftHours($shiftHours)
    {
        $this->shiftHours = $shiftHours;

        return $this;
    }

    /**
     * Get shiftHours
     *
     * @return int
     */
    public function getShiftHours()
    {
        return $this->shiftHours;
    }

    /**
     * Set workDays
     *
     * @param string $workDays
     *
     * @return Shift
     */
    public function setWorkDays($workDays)
    {
        $this->workDays = $workDays;

        return $this;
    }

    /**
     * Get workDays
     *
     * @return string
     */
    public function getWorkDays()
    {
        return $this->workDays;
    }

    /**
     * Set offDays
     *
     * @param string $offDays
     *
     * @return Shift
     */
    public function setOffDays($offDays)
    {
        $this->offDays = $offDays;

        return $this;
    }

    /**
     * Get offDays
     *
     * @return string
     */
    public function getOffDays()
    {
        return $this->offDays;
    }

    /**
     * Set shiftDays
     *
     * @param integer $shiftDays
     *
     * @return Shift
     */
    public function setShiftDays($shiftDays)
    {
        $this->shiftDays = $shiftDays;

        return $this;
    }

    /**
     * Get shiftDays
     *
     * @return int
     */
    public function getShiftDays()
    {
        return $this->shiftDays;
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
    
    /**
     * Add userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     *
     * @return User
     */
    public function addSchedule(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Remove userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     */
    public function removeSchedule(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles->removeElement($userRole);
    }    
}

