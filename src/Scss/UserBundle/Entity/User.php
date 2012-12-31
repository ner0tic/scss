<?php
// src/Scss/UserBundle/Entity/User.php

namespace Scss\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Scss\EnrollmentBundle\Entity\ActiveEnrollment;
use FOS\UserBundle\Model\GroupInterface;

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
     * @ORM\Column(length=128, unique=true, nullable=true)
     */
    protected $slug;
    
    /**
     * @ORM\Column(type="string", length=150, nullable=true) 
     */
    protected $first_name;
    
    /**
     * @ORM\Column(type="string", length=150, nullable=true) 
     */
    protected $last_name;
    
    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updated;    

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255, nullable=true)
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="googleId", type="string", length=255, nullable=true)
     */
    protected $googleId;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="linkedinId", type="string", length=255, nullable=true)
     */
    protected $linkedinId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="twitterId", type="string", length=255, nullable=true)
     */
    protected $twitterId;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="foursquareId", type="string", length=255, nullable=true)
     */
    protected $foursquareId;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\EnrollmentBundle\Entity\PasselEnrollment", inversedBy="user")
     * @ORM\JoinColumn(name="active_enrollment_id", referencedColumnName="id", nullable=true)
     */        
    protected $active_enrollment;    
    
    /**
     * @var string
     * 
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    protected $avatar = '/images/avatars/default.png';
    
//    public function serialize()
//    {
//        return serialize(array($this->facebookId, parent::serialize()));
//    }
//
//    public function unserialize($data)
//    {
//        list($this->facebookId, $parentData) = unserialize($data);
//        parent::unserialize($parentData);
//    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
        $this->salt = '';
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstName($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastName($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }
    
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
     * @param Scss\EntityBundle\Entity\PasselEnrollment $activeEnrollment
     * @return User
     */
    public function setActiveEnrollment(ActiveEnrollment $activeEnrollment = null)
    {
        $this->active_enrollment = $activeEnrollment;
        return $this;
    }

    /**
     * Get active_enrollment
     *
     * @return Scss\EnrollmentBundle\Entity\PasselEnrollment 
     */
    public function getActiveEnrollment()
    {
        return $this->active_enrollment;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
        return $this;
    }

    /**
     * Get googleId
     *
     * @return string 
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set linkedinId
     *
     * @param string $linkedinId
     * @return User
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;
        return $this;
    }

    /**
     * Get linkedinId
     *
     * @return string 
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Set twitterId
     *
     * @param string $twitterId
     * @return User
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
        return $this;
    }

    /**
     * Get twitterId
     *
     * @return string 
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }

    /**
     * Set foursquareId
     *
     * @param string $foursquareId
     * @return User
     */
    public function setFoursquareId($foursquareId)
    {
        $this->foursquareId = $foursquareId;
        return $this;
    }

    /**
     * Get foursquareId
     *
     * @return string 
     */
    public function getFoursquareId()
    {
        return $this->foursquareId;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    protected $groups;


    public function getRoles()
    {
        return $this->groups->toArray();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

    /**
     * Add groups
     *
     * @param Scss\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(GroupInterface $groups)
    {
        $this->groups[] = $groups;
        return $this;
    }

    /**
     * Remove groups
     *
     * @param Scss\UserBundle\Entity\Group $groups
     */
    public function removeGroup(GroupInterface $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}