<?php
    namespace Scss\FacilityBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo,
        Scss\UserBundle\Entity\User as BaseUser,
        PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

    /**
     * @ORM\Entity
     * @ORM\Table(name="faculty")
     * @UniqueEntity(fields = "username", targetClass = "Scss\UserBundle\Entity\User", message="fos_user.username_already")
     * @UniqueEntity(fields = "email", targetClass = "Scss\UserBundle\Entity\User", message="fos_user.email_already")
     */
    class Faculty extends BaseUser 
    {

      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

      /**
        * @ORM\Column(name="title", type="string", length=150)
        */
      protected $title;

      /**
       * @ORM\ManyToOne(targetEntity="Facility", inversedBy="faculty")
       * @ORM\JoinColumn(name="facilty_id", referencedColumnName="id")
       */    
      protected $facility;
      
      /**
       * @ORM\ManyToOne(targetEntity="Quarters", inversedBy="faculty")
       * @ORM\JoinColumn(name="quarters_id", referencedColumnName="id")
       */    
      protected $quarters;  
      protected $quarters_type = 'group';

      /**
        * @Gedmo\Slug(fields={"first_name", "last_name"}) 
        * @ORM\Column(name="slug", length=128, unique=true)
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

        /**
         * Set quarters
         *
         * @param Scss\FacilityBundle\Entity\Quarters $quarters
         * @return Faculty
         */
        public function setQuarters(\Scss\FacilityBundle\Entity\Quarters $quarters = null)
        {
            $this->quarters = $quarters;
            return $this;
        }

        /**
         * Get quarters
         *
         * @return Scss\FacilityBundle\Entity\Quarters 
         */
        public function getQuarters()
        {
            return $this->quarters;
        }
    }