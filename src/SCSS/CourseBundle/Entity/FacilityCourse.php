<?php
namespace SCSS\CourseBundle\Entity;

use SCSS\CourseBundle\Entity\Course;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="SCSS\CourseBundle\Repository\CourseRepository")
 * @ORM\Table(name="facility_course")
 */
class FacilityCourse
{
    use TimestampableTrait;
    

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Course", inversedBy="class")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     */
    protected $course = '';

    /**
     * Get course
     *
     * @return Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set course
     *
     * @param Course $course course
     *
     * @return Class
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Facility", inversedBy="facility_courses")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility = '';

    /**
     * Get facility
     *
     * @return Facility
     */
    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set facility
     *
     * @param Facility $facility facility
     *
     * @return Class
     */
    public function setFacility($facility)
    {
        $this->facility = $facility;

        return $this;
    }
}
