<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Scss\UserBundle\Entity\User;

/**
 * @ORM\Table(name="passel_leader")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\PasselLeaderRepository")
 */
class PasselLeader 
{
    /**
     * @ORM\ManyToOne(targetEntity="Passel", inversedBy="passel_leader")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel;
  
    /**
    * @Gedmo\Slug(fields={"first_name", "last_name"}) 
    * @ORM\Column(unique=true)
    * @Assert\MaxLength(128)
    */
    protected $slug;

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
     * @param Scss\OrganizationBundle\Entity\Passel $passel
     * @return GroupLeader
     */
    public function setPassel(\Scss\OrganizationBundle\Entity\Passel $passel = null)
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