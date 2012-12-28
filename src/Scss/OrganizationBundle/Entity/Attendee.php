<?php

namespace Scss\OrganizationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constratins as Assert;
use Scss\UserBundle\Entity\User;

/**
 * @ORM\Table(name="attendee")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\AttendeeRepository")
 */
class Attendee extends User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Faction", inversedBy="attendee")
     * @ORM\JoinColumn(name="faction_id", referencedColumnName="id")
     */
    protected $faction;
    
    /**
     * @ORM\ManyToOne(targetEntity="Passel", inversedBy="attendee")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel;
    
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
    * @Gedmo\Slug(fields={"first_name", "last_name"}) 
    * @ORM\Column(length=128, unique=true)
    */
    protected $slug;

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
     * @return Attendee
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
     * Set faction
     *
     * @param Scss\OrganizationBundle\Entity\Faction $faction
     * @return Attendee
     */
    public function setFaction(Faction $faction = null)
    {
        $this->faction = $faction;
        return $this;
    }

    /**
     * Get faction
     *
     * @return Scss\OrganizationBundle\Entity\Faction 
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Set passel
     *
     * @param Scss\OrganizationBundle\Entity\Passel $passel
     * @return Attendee
     */
    public function setPassel(Passel $passel = null)
    {
        $this->passel = $passel;
        return $this;
    }

    /**
     * Get passel
     *
     * @return Scss\OrganizationBundle\Entity\Passel 
     */
    public function getPassel()
    {
        return $this->passel;
    }

    /**
     * @var string $first_name
     */
    private $first_name;

    /**
     * @var string $last_name
     */
    private $last_name;

    /**
     * @var string $facebookId
     */
    private $facebookId;

    /**
     * @var string $googleId
     */
    private $googleId;

    /**
     * @var string $linkedinId
     */
    private $linkedinId;

    /**
     * @var string $twitterId
     */
    private $twitterId;

    /**
     * @var string $foursquareId
     */
    private $foursquareId;

    /**
     * @var string $avatar
     */
    private $avatar;

    /**
     * @var Scss\OrganizationBundle\Entity\ScssGroup
     */
    private $group;

    /**
     * @var Scss\FacilityBundle\Entity\GroupEnrollment
     */
    private $active_enrollment;


    /**
     * Set created
     *
     * @param datetime $created
     * @return Attendee
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
     * @return Attendee
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
     * Set first_name
     *
     * @param string $firstName
     * @return Attendee
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
     * @return Attendee
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
     * Set facebookId
     *
     * @param string $facebookId
     * @return Attendee
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     * @return Attendee
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
     * @return Attendee
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
     * @return Attendee
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
     * @return Attendee
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
     * @return Attendee
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
     * Set group
     *
     * @param Scss\OrganizationBundle\Entity\ScssGroup $group
     * @return Attendee
     */
    public function setGroup(\Scss\OrganizationBundle\Entity\ScssGroup $group = null)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return Scss\OrganizationBundle\Entity\ScssGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set active_enrollment
     *
     * @param Scss\FacilityBundle\Entity\GroupEnrollment $activeEnrollment
     * @return Attendee
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