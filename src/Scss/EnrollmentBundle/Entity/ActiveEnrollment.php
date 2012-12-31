<?php
namespace Scss\EnrollmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constratins as Assert;
use Scss\OrganizaitonBundle\Entity\Passel;
use Scss\FacilityBundle\Entity\Facility;
use Scss\CourseBundle\Entity\Week;
use Scss\UserBundle\Entity\User;

class ActiveEnrollment
{
    /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Passel", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */    
    protected $passel;
    
    /**
     * @ORM\ManyToOne(targetEntity="Facility", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;
    
    /**
     * @ORM\ManyToOne(targetEntity="Week", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
     */
    protected $week;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="active_enrollment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
}