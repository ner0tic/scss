<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\RankRepository")
 * @ORM\Table(name="rank")
 */
class Rank 
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
     *  @Assert\MaxLength(150)
     * @var type 
     */
    protected $name;
    
    /**
     * @ORM\Column(type="boolean") 
     */
    protected $special = false;
    

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
       * @return Rank
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
       * @return Rank
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
       * @return Rank
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
       * @return Rank
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
       * Set special
       *
       * @param boolean $special
       * @return Rank
       */
      public function setSpecial($special)
      {
          $this->special = $special;
          return $this;
      }

      /**
       * Get special
       *
       * @return boolean 
       */
      public function getSpecial()
      {
          return $this->special;
      }
}
