<?php
    namespace Scss\FacilityBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo;

    /**
     * @ORM\Entity
     * @ORM\Table(name="department")
     */
    class Department 
    {
      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

      /**
       * @ORM\Column(type="string", length=150)) 
       */
      protected $name;
      
      /**
       * @ORM\ManyToOne(targetEntity="Department", inversedBy="department")
       * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
       */     
      protected $parent;

      /**
       * @ORM\ManyToOne(targetEntity="Facility", inversedBy="department")
       * @ORM\JoinColumn(name="facilty_id", referencedColumnName="id")
       */    
      protected $facility;  
      
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
         * Set name
         *
         * @param string $name
         * @return Department
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
         * Set created
         *
         * @param datetime $created
         * @return Department
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
         * @return Department
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
         * @return Department
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
         * Set parent
         *
         * @param Scss\FacilityBundle\Entity\Department $parent
         * @return Department
         */
        public function setParent(\Scss\FacilityBundle\Entity\Department $parent = null)
        {
            $this->parent = $parent;
            return $this;
        }

        /**
         * Get parent
         *
         * @return Scss\FacilityBundle\Entity\Department
         */
        public function getParent()
        {
            return $this->parent;
        }

        /**
         * Set facility
         *
         * @param Scss\FacilityBundle\Entity\Facility $facility
         * @return Department
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