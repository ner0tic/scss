<?php
// src/Scss/UserBundle/Entity/User.php

namespace Scss\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Gedmo\Slug(fields={"first_name", "last_name"}) 
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="string", length=150) 
     */
    protected $first_name;
    
    /**
     * @ORM\Column(type="string", length=150) 
     */
    protected $last_name;
    
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;    
    
   /**
    * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\GroupEnrollment", inversedBy="user")
    * @ORM\JoinColumn(name="active_enrollment_id", referencedColumnName="id")
    */    
    protected $active_enrollment;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set slug
     *
     * @param string $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set active_enrollment
     *
     * @param Scss\FacilityBundle\Entity\GroupEnrollment $activeEnrollment
     * @return User
     */
    public function setActiveEnrollment(\Scss\FacilityBundle\Entity\GroupEnrollment $activeEnrollment = null)
    {
        $this->active_enrollment = $activeEnrollment;
        return $this;
    }

    /**
     * Get active_enrollment
     *
     * @return Scss\FacilityBundle\Entity\GroupEnrollment 
     */
    public function getActiveEnrollment()
    {
        return $this->active_enrollment;
    }
}