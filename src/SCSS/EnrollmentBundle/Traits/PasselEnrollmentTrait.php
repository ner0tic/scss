<?php
namespace SCSS\EnrollmentBundle\Traits;

trait PasselEnrollmentTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Passel", inversedBy="passel_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Facility", inversedBy="passel_enrollment")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Week", inversedBy="passel_enrollment")
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
     * Set passel
     *
     * @param  SCSS\PasselBundle\Entity\Passel $passel
     * @return PasselEnrollment
     */
    public function setPassel(Passel $passel = null)
    {
        $this->passel = $passel;

        return $this;
    }

    /**
     * Get passel
     *
     * @return SCSS\PasselBundle\Entity\Passel
     */
    public function getPassel()
    {
        return $this->passel;
    }

    /**
     * Set facility
     *
     * @param  SCSS\FacilityBundle\Entity\Facility $facility
     * @return PasselEnrollment
     */
    public function setFacility(Facility $facility = null)
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
     * @return PasselEnrollment
     */
    public function setWeek(Week $week = null)
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
}
