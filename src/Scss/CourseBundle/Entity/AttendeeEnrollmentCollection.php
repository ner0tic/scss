<?php
namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Scss\CourseBundle\Repository\AttendeeEnrollmentCollectionRepository")
 * @ORM\Table(name="attendee_enrollment_collection")
 */
class AttendeeEnrollmentCollection {
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  /**
   * @ORM\OneToMany(targetEntity="AttendeeEnrollment", mappedBy="attendee_entollment_collection")
   */
  protected $enrollments;  
  
  /**
    * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Attendee", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="attendee_id", referencedColumnName="id")
    */    
  protected $attendee; 
  
  /**
    * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
    */    
  protected $facility;
  
  /**
    * @ORM\ManyToOne(targetEntity="Week", inversedBy="attendee_entollment_collection")
    * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
    */    
  protected $week;  
  
  public function __construct()
  {
      $this->enrollments = new ArrayCollection();
  }
}