<?php

namespace Scss\OrganizationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
//use Vich\GeographicalBundle\Annotation as Geo;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="attendee")
 */
class Attendee {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
  * @ORM\Column(type="string", length=250)
  */
  protected $first_name;
  
  /**
  * @ORM\Column(type="string", length=250)
  */
  protected $last_name;
  
  /**
  * @ORM\Column(type="date")
  */
  protected $birthdate;
  
  /**
   * @ORM\ManyToOne(targetEntity="SubGroup", inversedBy="attendee")
   * @ORM\JoinColumn(name="sub_group_id", referencedColumnName="id")
   */
  protected $sub_group;
  
  /**
   * @ORM\ManyToOne(targetEntity="ScssGroup", inversedBy="attendee")
   * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
   */
  protected $scss_group;
  
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
  * @Gedmo\Slug(fields={"first_name", "last_name"}) 
  * @ORM\Column(length=128, unique=true)
  */
  protected $slug;

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
     * Set first_name
     *
     * @param string $firstName
     * @return Attendee
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
     * @return Attendee
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
     * @return Attendee
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
     * Set created
     *
     * @param datetime $created
     * @return Attendee
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
     * @return Attendee
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
     * Set slug
     *
     * @param string $slug
     * @return Attendee
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
     * Set sub_group
     *
     * @param Scss\OrganizationBundle\Entity\SubGroup $subGroup
     * @return Attendee
     */
    public function setSubGroup(\Scss\OrganizationBundle\Entity\SubGroup $subGroup = null)
    {
        $this->sub_group = $subGroup;
        return $this;
    }

    /**
     * Get sub_group
     *
     * @return Scss\OrganizationBundle\Entity\SubGroup 
     */
    public function getSubGroup()
    {
        return $this->sub_group;
    }

    /**
     * Set group
     *
     * @param Scss\OrganizationBundle\Entity\ScssGroup $group
     * @return Attendee
     */
    public function setScssGroup(\Scss\OrganizationBundle\Entity\ScssGroup $scss_group = null)
    {
        $this->scss_group = $scss_group;
        return $this;
    }

    /**
     * Get group
     *
     * @return Scss\OrganizationBundle\Entity\ScssGroup 
     */
    public function getScssGroup()
    {
        return $this->scss_group;
    }
}