<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Vich\GeographicalBundle\Annotation as Geo;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sub_group")
 */
class SubGroup {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=150)
   */
  protected $name;

  /**
   * @ORM\Column(type="string", length=250)
   */
  protected $photo;

  /**
   * @ORM\Column(type="string", length=250)
   */
  protected $logo;
  
  /**
   * @ORM\OneToMany(targetEntity="Attendee", mappedBy="sub_group")
   */
  protected $attendees;  
  
  /**
    * @ORM\ManyToOne(targetEntity="ScssGroup", inversedBy="sub_group")
    * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
    */    
  protected $group;  
  
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
  * @Gedmo\Slug(fields={"name"}) 
  * @ORM\Column(length=128, unique=true)
  */
  protected $slug;  
    public function __construct()
    {
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
     * @return SubGroup
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
     * @return SubGroup
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
     * @return SubGroup
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
     * Set created
     *
     * @param datetime $created
     * @return SubGroup
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
     * @return SubGroup
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
     * Set slug
     *
     * @param string $slug
     * @return SubGroup
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
     * Add attendees
     *
     * @param Scss\OrganizationBundle\Entity\Attendee $attendees
     * @return SubGroup
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
     * Set group
     *
     * @param Scss\OrganizationBundle\Entity\ScssGroup $group
     * @return SubGroup
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
}