<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="organization")
 */
class Organization {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @Gedmo\Slug(fields={"name"}) 
    * @ORM\Column(length=128, unique=true)
    */
  protected $slug;

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
    * @ORM\Column(type="string", length=150)
    * @var type 
    */
  protected $name;
  
  /**
   * @ORM\Column(type="string", length=10)
   * @var type 
   */
  protected $code;
  
  /**
   * @ORM\Column(type="string", length=150)
   * @var type 
   */
  protected $zone;
  
  /**
   * @ORM\Column(type="string", length=200)
   * @var type 
   */
  protected $country;
}

?>