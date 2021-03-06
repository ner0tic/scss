<?php
namespace SCSS\EnrollmentBundle\Traits;

trait AttendeeEnrollmentCollectionTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AttendeeEnrollment", mappedBy="attendee_enrollment_collection")
     */
    protected $enrollments;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Attendee", inversedBy="attendee_enrollment_collection")
     * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
     */
    protected $attendee;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Facility", inversedBy="attendee_enrollment_collection")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Week", inversedBy="attendee_enrollment_collection")
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
     * Add enrollments
     *
     * @param  SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments
     * @return AttendeeEnrollmentCollection
     */
    public function addAttendeeEnrollment(\SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments)
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
     * @param  SCSS\PasselBundle\Entity\Attendee $attendee
     * @return AttendeeEnrollmentCollection
     */
    public function setAttendee(\SCSS\PasselBundle\Entity\Attendee $attendee = null)
    {
        $this->attendee = $attendee;

        return $this;
    }

    /**
     * Get attendee
     *
     * @return SCSS\PasselBundle\Entity\Attendee
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * Set facility
     *
     * @param  SCSS\FacilityBundle\Entity\Facility $facility
     * @return AttendeeEnrollmentCollection
     */
    public function setFacility(\SCSS\FacilityBundle\Entity\Facility $facility = null)
    {
        $this->facility = $facility;

        return $this;
    }

    /**
     * Get facility
     *
     * @return SCSS\FacilityBundle\Entity\Facility
     */
    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set week
     *
     * @param  SCSS\CourseBundle\Entity\Week $week
     * @return AttendeeEnrollmentCollection
     */
    public function setWeek(SCSS\CourseBundle\Entity\Week $week = null)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * Get week
     *
     * @return SCSS\CourseBundle\Entity\Week
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Add enrollments
     *
     * @param  SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments
     * @return AttendeeEnrollmentCollection
     */
    public function addEnrollment(SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments)
    {
        $this->enrollments[] = $enrollments;

        return $this;
    }

    /**
     * Remove enrollments
     *
     * @param SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments
     */
    public function removeEnrollment(SCSS\EnrollmentBundle\Entity\AttendeeEnrollment $enrollments)
    {
        $this->enrollments->removeElement($enrollments);
    }
}
