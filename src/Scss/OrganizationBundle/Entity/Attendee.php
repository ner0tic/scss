<?php

namespace Scss\OrganizationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constratins as Assert;
use Scss\UserBundle\Entity\User;

/**
 * @ORM\Table(name="attendee")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\AttendeeRepository")
 */
class Attendee extends User
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

}
