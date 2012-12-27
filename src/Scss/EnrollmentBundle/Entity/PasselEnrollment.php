<?php

namespace Scss\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *  @ORM\Entity(repositoryClass="Scss\EnrollmentBundle\Repository\PasselEnrollmentCollectionRepository")
 * @ORM\Table(name="passel_enrollment")
 */
class PasselEnrollment {

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
   * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Passel", inversedBy="passel_enrollment")
   * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
   */        
  protected $passel;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="passel_enrollment")
   * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
   */        
  protected $facility;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\CourseBundle\Entity\Week", inversedBy="passel_enrollment")
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
     * @return PasselEnrollment
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
     * @return PasselEnrollment
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
     * @return PasselEnrollment
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
     * Set passel
     *
     * @param Scss\OrganizationBundle\Entity\Passel $passel
     * @return PasselEnrollment
     */
    public function setPassel(\Scss\OrganizationBundle\Entity\Passel $passel = null)
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
     * Set facility
     *
     * @param Scss\FacilityBundle\Entity\Facility $facility
     * @return PasselEnrollment
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
     * @return PasselEnrollment
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
