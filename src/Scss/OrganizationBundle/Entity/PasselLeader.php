<?php

namespace Scss\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Scss\UserBundle\Entity\User as BaseUser;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="passel_leader")
 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\PasselLeaderRepository")
 * @UniqueEntity(fields = "username", targetClass = "Scss\UserBundle\Entity\User", message="fos_user.username_already")
 * @UniqueEntity(fields = "email", targetClass = "Scss\UserBundle\Entity\User", message="fos_user.email_already")
 */
class PasselLeader extends BaseUser
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