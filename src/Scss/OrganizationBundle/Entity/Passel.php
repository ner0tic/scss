<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="passel")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\PasselRepository")
 */
class Passel 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\MaxLength(250)
     * @var type 
     */
    protected $name;
  
    /**
     * @ORM\ManyToOne(targetEntity="PasselType", inversedBy="passel")
     * @ORM\JoinColumn(name="passel_type_id", referencedColumnName="id")
     */    
     protected $passel_type;
  
     /**
      * @ORM\ManyToOne(targetEntity="Scss\GeographyBundle\Entity\Region", inversedBy="scss_group")
      * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
      */      
     protected $region;
  
     /**
      * @ORM\Column(type="string")
      * @Assert\MaxLength(250)
      */
     protected $photo;
  
     /**
      * @ORM\Column(type="string")
      * @Assert\MaxLength(250)
      */
     protected $logo;
  
     /**
      * @ORM\ManyToOne(targetEntity="PasselLeader", inversedBy="passel")
      * @ORM\JoinColumn(name="leader_id", referencedColumnName="id")
      */
     protected $leader;
  
     /**
      * @ORM\OneToMany(targetEntity="PasselLeader", mappedBy="passel")
      */
     protected $leaders;

     /**
      * @ORM\OneToMany(targetEntity="Faction", mappedBy="passel")
      */
     protected $factions;  
  
     /**
      * @ORM\OneToMany(targetEntity="Attendee", mappedBy="passel")
      */
     protected $attendees;  
  
     /**
      * @Gedmo\Slug(fields={"name"}) 
      * @ORM\Column(unique=true)
      * @Assert\MaxLength(128)
      */
     protected $slug;

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
    
     public function __construct()
     {
         $this->leaders   = new \Doctrine\Common\Collections\ArrayCollection();
         $this->factions  = new \Doctrine\Common\Collections\ArrayCollection();
         $this->attendees = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Passel
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
     * Set photo
     *
     * @param string $photo
     * @return Passel
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Passel
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ScssGroup
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
     * Set created
     *
     * @param datetime $created
     * @return ScssGroup
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
     * @return ScssGroup
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
     * Set passel type
     *
     * @param Scss\OrganizationBundle\Entity\PasselType $passelType
     * @return Passel
     */
    public function setPasselType(\Scss\OrganizationBundle\Entity\PasselType $passelType = null)
    {
        $this->passel_type = $passelType;
        return $this;
    }

    /**
     * Get passel type
     *
     * @return Scss\OrganizationBundle\Entity\PasselType 
     */
    public function getPasselType()
    {
        return $this->passel_type;
    }

    /**
     * Set region
     *
     * @param Scss\GeographyBundle\Entity\Region $region
     * @return Passel
     */
    public function setRegion(\Scss\GeographyBundle\Entity\Region $region = null)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Get region
     *
     * @return Scss\GeographicBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set leader
     *
     * @param Scss\OrganizationBundle\Entity\PasselLeader $leader
     * @return Passel
     */
    public function setLeader(Scss\OrganizationBundle\Entity\PasselLeader $leader = null)
    {
        $this->leader = $leader;
        return $this;
    }

    /**
     * Get leader
     *
     * @return Scss\OrganizationBundle\Entity\PasselLeader 
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Add leaders
     *
     * @param Scss\OrganizationBundle\Entity\PasselLeader $leaders
     * @return Passel
     */
    public function addPasselLeader(Scss\OrganizationBundle\Entity\PasselLeader $leaders)
    {
        $this->leaders[] = $leaders;
        return $this;
    }

    /**
     * Get leaders
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLeaders()
    {
        return $this->leaders;
    }

    /**
     * Add factions
     *
     * @param Scss\OrganizationBundle\Entity\Faction $faction
     * @return Passel
     */
    public function addFaction(Scss\OrganizationBundle\Entity\Faction $faction)
    {
        $this->factions[] = $factions;
        return $this;
    }

    /**
     * Get factions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFactions()
    {
        return $this->factions;
    }

    /**
     * Add attendees
     *
     * @param Scss\OrganizationBundle\Entity\Attendee $attendees
     * @return ScssGroup
     */
    public function addAttendee(\Scss\OrganizationBundle\Entity\Attendee $attendees)
    {
        $this->attendees[] = $attendees;
        return $this;
    }

    /**
     * Get attendees
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Add leaders
     *
     * @param Scss\OrganizationBundle\Entity\GroupLeader $leaders
     * @return ScssGroup
     */
    public function addLeader(\Scss\OrganizationBundle\Entity\GroupLeader $leaders)
    {
        $this->leaders[] = $leaders;
        return $this;
    }

    /**
     * Remove leaders
     *
     * @param Scss\OrganizationBundle\Entity\GroupLeader $leaders
     */
    public function removeLeader(\Scss\OrganizationBundle\Entity\GroupLeader $leaders)
    {
        $this->leaders->removeElement($leaders);
    }

    /**
     * Remove factions
     *
     * @param Scss\OrganizationBundle\Entity\Faction $factions
     */
    public function removeFaction(\Scss\OrganizationBundle\Entity\Faction $factions)
    {
        $this->factions->removeElement($factions);
    }

    /**
     * Remove attendees
     *
     * @param Scss\OrganizationBundle\Entity\Attendee $attendees
     */
    public function removeAttendee(\Scss\OrganizationBundle\Entity\Attendee $attendees)
    {
        $this->attendees->removeElement($attendees);
    }
}