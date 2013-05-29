<?php
    namespace Scss\PasselBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo,
        Doctrine\Common\Collections\ArrayCollection,
        Symfony\Component\Validator\Constraints as Assert,
        Scss\UserBundle\Entity\User as BaseUser,
        PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

    /**
     * @ORM\Table(name="passel_leader")
     * @ORM\Entity(repositoryClass="Scss\PasselBundle\Repository\PasselLeaderRepository")
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
         * @return PasselLeader
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
         * Set Passel
         *
         * @param Scss\PasselBundle\Entity\Passel $passel
         * @return PasselLeader
         */
        public function setPassel(\Scss\PasselBundle\Entity\Passel $passel = null)
        {
            $this->passel = $passel;
            return $this;
        }

        /**
         * Get passel
         *
         * @return Scss\PasselBundle\Entity\Passel 
         */
        public function getPassel()
        {
            return $this->passel;
        }
    }