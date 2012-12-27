<?php

namespace Scss\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Scss\EnrollmentBundle\Repository\AttendeeEnrollmentRepository")
 * @ORM\Table(name="attendee_enrollment")
 */
class AttendeeEnrollment {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Attendee", inversedBy="attendee_enrollment")
   * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
   */         
  protected $attendee;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\CourseBundle\Entity\ScssClass", inversedBy="attendee_enrollment")
   * @ORM\JoinColumn(name="class_id", referencedColumnName="id")
   */         
  protected $class;
  
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
     * @return AttendeeEnrollment
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
     * @return AttendeeEnrollment
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
     * Set attendee
     *
     * @param Scss\OrganizationBundle\Entity\Attendee $attendee
     * @return AttendeeEnrollment
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
     * Set class
     *
     * @param Scss\CourseBundle\Entity\ScssClass $class
     * @return AttendeeEnrollment
     */
    public function setClass(\Scss\CourseBundle\Entity\ScssClass $class = null)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * Get class
     *
     * @return Scss\CourseBundle\Entity\ScssClass 
     */
    public function getClass()
    {
        return $this->class;
    }
}
