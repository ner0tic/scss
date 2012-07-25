<?php

namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="requirement")
 */
class Requirement {

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
   * @ORM\Column(type="boolean")
   * @var type 
   */
  protected $optional = false;
  
  /**
   * @ORM\ManyToOne(targetEntity="Requirement", inversedBy="requirement")
   * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
   */        
  protected $parent;
  
  /**
   * @ORM\Column(type="text")
   * @var type 
   */
  protected $text;
  
  /**
   * @ORM\ManyToOne(targetEntity="MeritBadge", inversedBy="requirement")
   * @ORM\JoinColumn(name="meritbadge_id", referencedColumnName="id")
   */  
  protected $meritbadge;

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
     * @return Requirement
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
     * @return Requirement
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
     * @return Requirement
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
     * @return Requirement
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
     * Set optional
     *
     * @param boolean $optional
     * @return Requirement
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;
        return $this;
    }

    /**
     * Get optional
     *
     * @return boolean 
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * Set text
     *
     * @param text $text
     * @return Requirement
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set parent
     *
     * @param Scss\CourseBundle\Entity\Requirement $parent
     * @return Requirement
     */
    public function setParent(\Scss\CourseBundle\Entity\Requirement $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Scss\CourseBundle\Entity\Requirement 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set meritbadge
     *
     * @param Scss\CourseBundle\Entity\MeritBadge $meritbadge
     * @return Requirement
     */
    public function setMeritbadge(\Scss\CourseBundle\Entity\MeritBadge $meritbadge = null)
    {
        $this->meritbadge = $meritbadge;
        return $this;
    }

    /**
     * Get meritbadge
     *
     * @return Scss\CourseBundle\Entity\MeritBadge 
     */
    public function getMeritbadge()
    {
        return $this->meritbadge;
    }
}