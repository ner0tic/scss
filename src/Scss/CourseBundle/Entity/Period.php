<?php

namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="period")
 */
class Period {

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
  protected $special = false;
  
  /**
   * @ORM\ManyToOne(targetEntity="Week", inversedBy="period")
   * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
   */        
  protected $week;  
  
  /**
   * @ORM\Column(type="time")
   */
  protected $start;
  
  /**
   * @ORM\Column(type="time")
   */
  protected $end;
  

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
     * @return Period
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
     * @return Period
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
     * @return Period
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
     * @return Period
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
     * @return Period
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

    /**
     * Set start
     *
     * @param time $start
     * @return Period
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * Get start
     *
     * @return time 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param time $end
     * @return Period
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * Get end
     *
     * @return time 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set week
     *
     * @param Scss\CourseBundle\Entity\Week $week
     * @return Period
     */
    public function setWeek(\Scss\CourseBundle\Entity\Week $week = null)
    {
        $this->week = $week;
        return $this;
    }

    /**
     * Get week
     *
     * @return Scss\CourseBundle\Entity\Week 
     */
    public function getWeek()
    {
        return $this->week;
    }
}