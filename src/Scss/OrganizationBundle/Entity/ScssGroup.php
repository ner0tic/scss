<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="scss_group")
 */
class ScssGroup {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=150)
   * @var type 
   */
  protected $name;
  
  /**
   * @ORM\ManyToOne(targetEntity="GroupType", inversedBy="scss_group")
   * @ORM\JoinColumn(name="group_type_id", referencedColumnName="id")
   */    
  protected $group_type;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\GeographyBundle\Entity\Region", inversedBy="scss_group")
   * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
   */      
  protected $region;
  
  /**
   * @ORM\Column(type="string", length=250)
   */
  protected $photo;
  
  /**
   * @ORM\Column(type="string", length=250)
   */
  protected $logo;
  
  /**
   * @ORM\ManyToOne(targetEntity="GroupLeader", inversedBy="scss_group")
   * @ORM\JoinColumn(name="leader_id", referencedColumnName="id")
   */
  protected $leader;
  
  /**
   * @ORM\OneToMany(targetEntity="GroupLeader", mappedBy="scss_group")
   */
  protected $leaders;

  /**
   * @ORM\OneToMany(targetEntity="SubGroup", mappedBy="scss_group")
   */
  protected $sub_groups;  
  
  /**
   * @ORM\OneToMany(targetEntity="Attendee", mappedBy="scss_group")
   */
  protected $attendees;  
  
  /**
    * @Gedmo\Slug(fields={"name"}) 
    * @ORM\Column(length=128, unique=true)
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
        $this->leaders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sub_groups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ScssGroup
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
     * @return ScssGroup
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
     * @return ScssGroup
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
     * Set group_type
     *
     * @param Scss\OrganizationBundle\Entity\GroupType $groupType
     * @return ScssGroup
     */
    public function setGroupType(\Scss\OrganizationBundle\Entity\GroupType $groupType = null)
    {
        $this->group_type = $groupType;
        return $this;
    }

    /**
     * Get group_type
     *
     * @return Scss\OrganizationBundle\Entity\GroupType 
     */
    public function getGroupType()
    {
        return $this->group_type;
    }

    /**
     * Set region
     *
     * @param Scss\GeographyBundle\Entity\Region $region
     * @return ScssGroup
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
     * @param Scss\OrganizationBundle\Entity\GroupLeader $leader
     * @return ScssGroup
     */
    public function setLeader(\Scss\OrganizationBundle\Entity\GroupLeader $leader = null)
    {
        $this->leader = $leader;
        return $this;
    }

    /**
     * Get leader
     *
     * @return Scss\OrganizationBundle\Entity\GroupLeader 
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Add leaders
     *
     * @param Scss\OrganizationBundle\Entity\GroupLeader $leaders
     * @return ScssGroup
     */
    public function addGroupLeader(\Scss\OrganizationBundle\Entity\GroupLeader $leaders)
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
     * Add sub_groups
     *
     * @param Scss\OrganizationBundle\Entity\SubGroup $subGroups
     * @return ScssGroup
     */
    public function addSubGroup(\Scss\OrganizationBundle\Entity\SubGroup $subGroups)
    {
        $this->sub_groups[] = $subGroups;
        return $this;
    }

    /**
     * Get sub_groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSubGroups()
    {
        return $this->sub_groups;
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
}