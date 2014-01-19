<?php
namespace SCSS\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="SCSS\EnrollmentBundle\Repository\AttendeeEnrollmentCollectionRepository")
 * @ORM\Table(name="attendee_enrollment_collection")
 */
class AttendeeEnrollmentCollection
{
    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
    }

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
}
