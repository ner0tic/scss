<?php

namespace Scss\FacilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_enrollment")
 */
class GroupEnrollment {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

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
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\ScssGroup", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
   */        
  protected $group;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
   */        
  protected $facility;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\CourseBundle\Entity\Week", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
   */        
  protected $week;

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
     * Set created
     *
     * @param datetime $created
     * @return GroupEnrollment
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
     * @return GroupEnrollment
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
     * @return GroupEnrollment
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
     * Set group
     *
     * @param Scss\OrganizationBundle\Entity\ScssGroup $group
     * @return GroupEnrollment
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
     * Set facility
     *
     * @param Scss\FacilityBundle\Entity\Facility $facility
     * @return GroupEnrollment
     */
    public function setFacility(\Scss\FacilityBundle\Entity\Facility $facility = null)
    {
        $this->facility = $facility;
        return $this;
    }

    /**
     * Get facility
     *
     * @return Scss\FacilityBundle\Entity\Facility 
     */
    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set week
     *
     * @param Scss\CourseBundle\Entity\Week $week
     * @return GroupEnrollment
     */
    public function setWeek(\Scss\CourseBundle\Entity\Week $week = null)
    {
        $this->week = $week;
        return $this;
    }

    /**
     * Get week
     *
     * @return Scss\CourseBundle\Entity\Week 
     */
    public function getWeek()
    {
        return $this->week;
    }
}