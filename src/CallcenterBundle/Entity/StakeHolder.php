<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StakeHolder
 *
 * @ORM\Table(name="stake_holder")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\StakeHolderRepository")
 */
class StakeHolder
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
     * @ORM\Column(name="stakeHolderCode", type="string", length=25)
     */
    private $stakeHolderCode;


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
     * @return StakeHolder
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
     * Set stakeHolderCode
     *
     * @param string $stakeHolderCode
     *
     * @return StakeHolder
     */
    public function setStakeHolderCode($stakeHolderCode)
    {
        $this->stakeHolderCode = $stakeHolderCode;

        return $this;
    }

    /**
     * Get stakeHolderCode
     *
     * @return string
     */
    public function getStakeHolderCode()
    {
        return $this->stakeHolderCode;
    }
}

