<?php
namespace SCSS\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="SCSS\EnrollmentBundle\Repository\PasselEnrollmentCollectionRepository")
 * @ORM\Table(name="passel_enrollment")
 */
class PasselEnrollment
{
    use TimestampableTrait;

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
}
