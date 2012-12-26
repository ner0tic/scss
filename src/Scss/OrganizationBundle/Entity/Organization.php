<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\OrganizationRepository")
 * @ORM\Table(name="organization")
 */
class Organization 
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @Gedmo\Slug(fields={"name"}) 
    * @ORM\Column(unique=true)
    * @Assert\MaxLength(128)
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
      * @ORM\Column(type="string")
      * @Assert\MaxLength(150)
      * @var type 
      */
    protected $name;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\MaxLength(10)
     * @var type 
     */
    protected $code;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\MaxLength(150)
     * @var type 
     */
    protected $zone;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\MaxLength(200)
     * @var type 
     */
    protected $country;

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
       * Set slug
       *
       * @param string $slug
       * @return Organization
       */
      public function setSlug($slug)
      {
          $this->slug = $slug;
          return $this;
      }

      /**
       * Get slug
       *
       * @return string 
       */
      public function getSlug()
      {
          return $this->slug;
      }

      /**
       * Set created
       *
       * @param datetime $created
       * @return Organization
       */
      public function setCreated($created)
      {
          $this->created = $created;
          return $this;
      }

      /**
       * Get created
       *
       * @return datetime 
       */
      public function getCreated()
      {
          return $this->created;
      }

      /**
       * Set updated
       *
       * @param datetime $updated
       * @return Organization
       */
      public function setUpdated($updated)
      {
          $this->updated = $updated;
          return $this;
      }

      /**
       * Get updated
       *
       * @return datetime 
       */
      public function getUpdated()
      {
          return $this->updated;
      }

      /**
       * Set name
       *
       * @param string $name
       * @return Organization
       */
      public function setName($name)
      {
          $this->name = $name;
          return $this;
      }

      /**
       * Get name
       *
       * @return string 
       */
      public function getName()
      {
          return $this->name;
      }

      /**
       * Set code
       *
       * @param string $code
       * @return Organization
       */
      public function setCode($code)
      {
          $this->code = $code;
          return $this;
      }

      /**
       * Get code
       *
       * @return string 
       */
      public function getCode()
      {
          return $this->code;
      }

      /**
       * Set zone
       *
       * @param string $zone
       * @return Organization
       */
      public function setZone($zone)
      {
          $this->zone = $zone;
          return $this;
      }

      /**
       * Get zone
       *
       * @return string 
       */
      public function getZone()
      {
          return $this->zone;
      }

      /**
       * Set country
       *
       * @param string $country
       * @return Organization
       */
      public function setCountry($country)
      {
          $this->country = $country;
          return $this;
      }

      /**
       * Get country
       *
       * @return string 
       */
      public function getCountry()
      {
          return $this->country;
      }
}
