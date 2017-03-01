<?php

namespace AuthBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role 
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="AuthBundle\Repository\RoleRepository")
 * @ORM\HasLifecycleCallbacks()
*/
class Role implements RoleInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string $name
     */
    protected $name;
    
        /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string $slug
     */
    protected $slug;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;
    
    /**
     * 
     * @var ArrayCollection $users
     * @ORM\ManyToMany(targetEntity="AuthBundle\Entity\User", mappedBy="userRoles")
    */
    protected $users;
    
    /**
     * 
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
    }
    
    /**
     * 
     *
     * @return integer The id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     *
     * @return string The name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     *
     * @param string $value The name.
     */
    public function setName($value)
    {
        $this->name = $value;
    }
    /**
     * 
     *
     * @return string The name.
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * 
     *
     * @param string $value The name.
     */
    public function setSlug($value)
    {
        $this->slug = $value;
    }

    /**
     * 
     *
     * @return DateTime A DateTime object.
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * RoleInterface.
     *
     * @return string The role.
     */
    public function getRole()
    {
        return $this->getName();
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Role
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Add user
     *
     * @param \AuthBundle\Entity\User $user
     *
     * @return Role
     */
    public function addUser(\AuthBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AuthBundle\Entity\User $user
     */
    public function removeUser(\AuthBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
