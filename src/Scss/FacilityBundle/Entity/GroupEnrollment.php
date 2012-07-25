<?php

namespace Scss\FacilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_enrollment")
 */
class GroupEnrollment {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(type="datetime")
    */
  private $created;

  /**
    * @var datetime $updated
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(type="datetime")
    */
  private $updated;

  /**
    * @Gedmo\Slug(fields={"name"}) 
    * @ORM\Column(length=128, unique=true)
    */
  protected $slug;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\ScssGroup", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
   */        
  protected $group;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Facility", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
   */        
  protected $facility;
  
  /**
   * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Week", inversedBy="group_enrollment")
   * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
   */        
  protected $week;
}

?>