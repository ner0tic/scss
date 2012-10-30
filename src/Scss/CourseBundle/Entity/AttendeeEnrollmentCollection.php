<?php
namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Scss\CourseBundle\Repository\AttendeeEnrollmentCollectionRepository")
 * @ORM\Table(name="attendee_enrollment_collection")
 */
class AttendeeEnrollmentCollection {
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  /**
   * @ORM\OneToMany(targetEntity="AttendeeEnrollment", mappedBy="attendee_entollment_collection")
   */
  protected $enrollments;  
  
  /**
    * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Attendee", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
    */    
  protected $attendee; 
  
  /**
    * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
    */    
  protected $facility;
  
  /**
    * @ORM\ManyToOne(targetEntity="Week", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
    */    
  protected $week;  
  
  public function __construct()
  {
      $this->enrollments = new ArrayCollection();
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
     * Add enrollments
     *
     * @param Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments
     * @return AttendeeEnrollmentCollection
     */
    public function addAttendeeEnrollment(\Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments)
    {
        $this->enrollments[] = $enrollments;
        return $this;
    }

    /**
     * Get enrollments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEnrollments()
    {
        return $this->enrollments;
    }

    /**
     * Set attendee
     *
     * @param Scss\OrganizationBundle\Entity\Attendee $attendee
     * @return AttendeeEnrollmentCollection
     */
    public function setAttendee(\Scss\OrganizationBundle\Entity\Attendee $attendee = null)
    {
        $this->attendee = $attendee;
        return $this;
    }

    /**
     * Get attendee
     *
     * @return Scss\OrganizationBundle\Entity\Attendee 
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * Set facility
     *
     * @param Scss\FacilityBundle\Entity\Facility $facility
     * @return AttendeeEnrollmentCollection
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
     * @return AttendeeEnrollmentCollection
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

    /**
     * Add enrollments
     *
     * @param Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments
     * @return AttendeeEnrollmentCollection
     */
    public function addEnrollment(\Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments)
    {
        $this->enrollments[] = $enrollments;
        return $this;
    }

    /**
     * Remove enrollments
     *
     * @param Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments
     */
    public function removeEnrollment(\Scss\CourseBundle\Entity\AttendeeEnrollment $enrollments)
    {
        $this->enrollments->removeElement($enrollments);
    }
}