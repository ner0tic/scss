<?php

namespace Scss\OrganizationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constratins as Assert;
use Scss\UserBundle\Entity\User as BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Table(name="attendee")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\AttendeeRepository")
 * @UniqueEntity(fields = "username", targetClass = "Scss\USerBundle\Entity\User", message="fos_user.username_already")
 * @UniqueEntity(fields = "email", targetClass = "Scss\USerBundle\Entity\User", message="fos_user.email_already")
 */
class Attendee extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Faction", inversedBy="attendee")
     * @ORM\JoinColumn(name="faction_id", referencedColumnName="id")
     */
    protected $faction;
    
    /**
     * @ORM\ManyToOne(targetEntity="Passel", inversedBy="attendee")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel;
    
    /**
    * @var datetime $created
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(type="datetime")
    */
    protected $created;

    /**
    * @var datetime $updated
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(type="datetime")
    */
    protected $updated;

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
     * Set faction
     *
     * @param Scss\OrganizationBundle\Entity\Faction $faction
     * @return Attendee
     */
    public function setFaction(Faction $faction = null)
    {
        $this->faction = $faction;
        return $this;
    }

    /**
     * Get faction
     *
     * @return Scss\OrganizationBundle\Entity\Faction 
     */
    public function getFaction()
    {
        return $this->faction;
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
     * Set passel
     *
     * @param Scss\OrganizationBundle\Entity\Passel $passel
     * @return Attendee
     */
    public function setPassel(Passel $passel = null)
    {
        $this->passel = $passel;
        return $this;
    }

    /**
     * Get passel
     *
     * @return Scss\OrganizationBundle\Entity\Passel 
     */
    public function getPassel()
    {
        return $this->passel;
    }

    public function __construct()
    {
        parent::construct();
    }
    
}