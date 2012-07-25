<?php

namespace Scss\GeographyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="address_book")
 */
class AddressBook {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="decimal", scale=7)
   */
  protected $latitude;

  /**
   * @ORM\Column(type="decimal", scale=7)
   */
  protected $longitude;
    
  /**
   * @ORM\Column(type="string", length=150)) 
   */
  protected $name;
  
  /**
   * @ORM\Column(type="string", length=150)) 
   */
  protected $street;
  
  /**
   * @ORM\Column(type="string", length=150)) 
   */  
  protected $suburb;
  
  /**
   * @ORM\Column(type="string", length=150)) 
   */  
  protected $city;
  
  /**
   * @ORM\Column(type="string", length=10)) 
   */  
  protected $postal_code;
  
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
}

