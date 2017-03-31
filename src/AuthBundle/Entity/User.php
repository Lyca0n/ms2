<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Description of User
 *
 * @author jvillalv
 */

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AuthBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;
    
    /**
     * @Assert\Length(max=4096)
     * @Assert\Length(min=8)
     */
    private $plainPassword;
    
    /** 
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;
    
    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     *
     * @var DateTime $updatedAt
     */
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="datetime", name="last_login_at", nullable=true)
     *
     * @var DateTime $lastLoginAt
     */
    protected $lastLoginAt;
    
    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    private $profilePicture;
    
    /**
     * @ORM\Column(type="string", length=180, unique=true, options={"default" : "default.png"})
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean", options={"default" : 0})
     */
    private $isActive;
    
    /**
     * @var ArrayCollection $userRoles
     * 
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $userRoles;
    
    /**
     * @ORM\OneToOne(targetEntity="CallcenterBundle\Entity\Employee")
     */
    private $employee;
    

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime("now");
    }
    
    public function setEmployee($id){
        $this->employeeId = $id;
    }
    
    public function getEmployee(){
        return $this->employeeId;
    }
    
    public function setLastLoginAt(){
        $this->lastLoginAt = new \DateTime('now');
    }
    
    public function getLastLoginAt(){
        return $this->lastLoginAt;
    }
    
    public function getCreatedAt(){
        return $this->lastLoginAt;
    }
    
    public function getUpdatedAt(){
        return $this->lastLoginAt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    
    public function getSalt()
    {
        
        return null;
    }    

    public function isActive()
    {
        return $this->isActive;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getplainPassword()
    {
        return $this->plainPassword;
    }
    
    public function getPicture()
    {
        return $this->profilePicture;
    }

    public function getRoles()
    {
        return $this->getUserRoles()->toArray();
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set profilePicture
     *
     * @param string $profilePicture
     *
     * @return User
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    /**
     * Get profilePicture
     *
     * @return string
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    /**
     * Add userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     *
     * @return User
     */
    public function addUserRole(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Remove userRole
     *
     * @param \AuthBundle\Entity\Role $userRole
     */
    public function removeUserRole(\AuthBundle\Entity\Role $userRole)
    {
        $this->userRoles->removeElement($userRole);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }
}
