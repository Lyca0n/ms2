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
     * 
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\ServiceUnit", mappedBy="stakeholder")
     */
    private $serviceunits;      

    /**
     * @ORM\ManyToOne(targetEntity="CallcenterBundle\Entity\CostCenter", inversedBy="stakeholders") 
     * @ORM\JoinColumn(name="costcenter_id", referencedColumnName="id")
     **/
    private $costcenter;           

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

    /**
     * Set costcenter
     *
     * @param \CallcenterBundle\Entity\CostCenter $costcenter
     *
     * @return StakeHolder
     */
    public function setCostcenter(\CallcenterBundle\Entity\CostCenter $costcenter = null)
    {
        $this->costcenter = $costcenter;

        return $this;
    }

    /**
     * Get costcenter
     *
     * @return \CallcenterBundle\Entity\CostCenter
     */
    public function getCostcenter()
    {
        return $this->costcenter;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->serviceunits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     *
     * @return StakeHolder
     */
    public function addServiceunit(\CallcenterBundle\Entity\ServiceUnit $serviceunit)
    {
        $this->serviceunits[] = $serviceunit;

        return $this;
    }

    /**
     * Remove serviceunit
     *
     * @param \CallcenterBundle\Entity\ServiceUnit $serviceunit
     */
    public function removeServiceunit(\CallcenterBundle\Entity\ServiceUnit $serviceunit)
    {
        $this->serviceunits->removeElement($serviceunit);
    }

    /**
     * Get serviceunits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServiceunits()
    {
        return $this->serviceunits;
    }
}
