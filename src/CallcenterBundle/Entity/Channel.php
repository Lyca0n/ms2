<?php

namespace CallcenterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity(repositoryClass="CallcenterBundle\Repository\ChannelRepository")
 */
class Channel
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;
    
    /**     
     * @ORM\OneToMany(targetEntity="CallcenterBundle\Entity\Segment", mappedBy="channel")
     */
    private $segments; 

    public function __construct() {
       $this->segments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Channel
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
     * Add segment
     *
     * @param \CallcenterBundle\Entity\Segment $segment
     *
     * @return Channel
     */
    public function addSegment(\CallcenterBundle\Entity\Segment $segment)
    {
        $this->segments[] = $segment;

        return $this;
    }

    /**
     * Remove segment
     *
     * @param \CallcenterBundle\Entity\Segment $segment
     */
    public function removeSegment(\CallcenterBundle\Entity\Segment $segment)
    {
        $this->segments->removeElement($segment);
    }

    /**
     * Get segments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSegments()
    {
        return $this->segments;
    }
}
