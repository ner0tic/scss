<?php
namespace SCSS\CourseBundle\Entity;

use SCSS\CourseBundle\Entity\Course;
use SCSS\CourseBundle\Entity\Course;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;
use SCSS\UtilityBundle\Traits\BlameableTrait;

/**
 * @Entity(repositoryClass="SCSS\CourseBundle\Repository\CourseRepository")
 * @Table(name="course")
 */
class FacilityCourse
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(region="integer")
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
        return $this->course-;
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
        return $this->course-;
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
}
