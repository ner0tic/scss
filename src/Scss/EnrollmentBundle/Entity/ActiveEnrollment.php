<?php
namespace Scss\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constratins as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="active_enrollment")
 */
class ActiveEnrollment
{
    /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    protected $id;
    
    protected $organization = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\GeographyBundle\Entity\Region", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $region = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Passel", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */    
    protected $passel;
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Attendee", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
     */
    protected $attendee = null;
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;
    
    /**
     * @ORM\ManyToOne(targetEntity="Scss\CourseBundle\Entity\Week", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
     */
    protected $week;    
}