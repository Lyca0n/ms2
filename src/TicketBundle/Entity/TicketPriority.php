<?php

namespace TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketPriority
 *
 * @ORM\Table(name="ticket_priority")
 * @ORM\Entity(repositoryClass="TicketBundle\Repository\TicketPriorityRepository")
 */
class TicketPriority
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
     * @ORM\Column(name="name", type="string", length=10, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="priorityValue", type="integer")
     */
    private $priorityValue;


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
     * @return TicketPriority
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
     * Set priorityValue
     *
     * @param integer $priorityValue
     *
     * @return TicketPriority
     */
    public function setPriorityValue($priorityValue)
    {
        $this->priorityValue = $priorityValue;

        return $this;
    }

    /**
     * Get priorityValue
     *
     * @return int
     */
    public function getPriorityValue()
    {
        return $this->priorityValue;
    }
}

