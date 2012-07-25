<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Vich\GeographicalBundle\Annotation as Geo;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="group_leader")
 */
class GroupLeader {

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
   * @ORM\ManyToOne(targetEntity="ScssGroup", inversedBy="group_leader")
   * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
   */
  protected $group;
  
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
     * @return GroupLeader
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
     * @return GroupLeader
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
     * @return GroupLeader
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
     * @return GroupLeader
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
     * @return GroupLeader
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
     * @return GroupLeader
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
     * Set group
     *
     * @param Scss\GroupBundle\Entity\ScssGroup $group
     * @return GroupLeader
     */
    public function setGroup(\Scss\GroupBundle\Entity\ScssGroup $group = null)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return Scss\GroupBundle\Entity\ScssGroup 
     */
    public function getGroup()
    {
        return $this->group;
    }
}