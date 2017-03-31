<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkForceAllocation
 *
 * @ORM\Table(name="work_force_allocation")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\WorkForceAllocationRepository")
 */
class WorkForceAllocation
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
     * @ORM\Column(name="allocation", type="integer")
     */
    private $allocation;


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
     * Set allocation
     *
     * @param integer $allocation
     *
     * @return WorkForceAllocation
     */
    public function setAllocation($allocation)
    {
        $this->allocation = $allocation;

        return $this;
    }

    /**
     * Get allocation
     *
     * @return int
     */
    public function getAllocation()
    {
        return $this->allocation;
    }
}

