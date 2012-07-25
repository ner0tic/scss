<?php

namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="course")
 */
class Course {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

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

  /**
   * @ORM\Column(type="string", length=150)
   * @var type 
   */
  protected $name;
  
  /**
   * @ORM\ManyToOne(targetEntity="MeritBadge", inversedBy="course")
   * @ORM\JoinColumn(name="meritbadge_id", referencedColumnName="id")
   */      
  protected $meritbadge;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="course")
   * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
   */      
  protected $facility;

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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * Set name
     *
     * @param string $name
     * @return Course
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
     * Set meritbadge
     *
     * @param Scss\CourseBundle\Entity\MeritBadge $meritbadge
     * @return Course
     */
    public function setMeritbadge(\Scss\CourseBundle\Entity\MeritBadge $meritbadge = null)
    {
        $this->meritbadge = $meritbadge;
        return $this;
    }

    /**
     * Get meritbadge
     *
     * @return Scss\CourseBundle\Entity\MeritBadge 
     */
    public function getMeritbadge()
    {
        return $this->meritbadge;
    }

    /**
     * Set facility
     *
     * @param Scss\FacilityBundle\Entity\Facility $facility
     * @return Course
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
}