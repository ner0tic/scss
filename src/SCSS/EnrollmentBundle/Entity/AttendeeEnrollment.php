<?php
    namespace SCSS\EnrollmentBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use SCSS\UtilityBundle\Traits\TimestampableTrait

    /**
     * @ORM\Entity(repositoryClass="SCSS\EnrollmentBundle\Repository\AttendeeEnrollmentRepository")
     * @ORM\Table(name="attendee_enrollment")
     */
    class AttendeeEnrollment
    {
        use TimestampableTrait;

        /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Organizaiton", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization = null;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Region", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $region = null;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Passel", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Attendee", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
     */
    protected $attendee = null;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Facility", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Week", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
     */
    protected $week;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\UserBundle\Entity\USer", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    }
