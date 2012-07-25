<?php

namespace Scss\FacilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="faculty")
 */
class Faculty {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
    * @Gedmo\Slug(fields={"first_name, last_name"}) 
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
    */
  protected $first_name;

  /**
    * @ORM\Column(type="string", length=150)
    */
  protected $last_name;    

  /**
    * @ORM\Column(type="date")
    */
  protected $birthdate;

  /**
    * @ORM\Column(type="string", length=150)
    */
  protected $title;

  /**
   * @ORM\ManyToOne(targetEntity="Facility", inversedBy="faculty")
   * @ORM\JoinColumn(name="facilty_id", referencedColumnName="id")
   */    
  protected $facility;
    

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
     * @return Faculty
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
     * @return Faculty
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
     * @return Faculty
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
     * Set first_name
     *
     * @param string $firstName
     * @return Faculty
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Faculty
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set birthdate
     *
     * @param date $birthdate
     * @return Faculty
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return date 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Faculty
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set facility
     *
     * @param Scss\FacilityBundle\Entity\Facility $facility
     * @return Faculty
     */
    public function setFacility(\Scss\FacilityBundle\Entity\Facility $facility = null)
    {
        $this->facility = $facility;
        return $this;
    }

    /**
     * Get facility
     *
     * @return Scss\FacilityBundle\Entity\Facility 
     */
    public function getFacility()
    {
        return $this->facility;
    }
}