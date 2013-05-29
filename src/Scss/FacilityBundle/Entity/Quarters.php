<?php
    namespace Scss\FacilityBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo;

    /**
     * @ORM\Entity
     * @ORM\Table(name="quarters")
     */
    class Quarters 
    {
      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

      /**
       * @ORM\Column(type="string", length=150)
       * @var type
       */
      protected $name;

      /**
       * @ORM\Column(type="string", length=100)
       */
      protected $type;

      /**
       * @ORM\Column(type="integer")
       */
      protected $max_occupy;

      /**
       * @ORM\Column(type="string", length=250)
       */
      protected $photo;

      /**
       * @ORM\ManyToOne(targetEntity="Facility", inversedBy="area")
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
         * Set type
         *
         * @param string $type
         * @return Quarters
         */
        public function setType($type)
        {
            if(!in_array($type,array('group', 'faculty')))
              throw new \InvalidArgumentException('Invalid option for a quarters type');
            $this->type = $type;
            return $this;
        }

        /**
         * Get type
         *
         * @return string
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * Set max_occupy
         *
         * @param integer $maxOccupy
         * @return Quarters
         */
        public function setMaxOccupy($maxOccupy)
        {
            $this->max_occupy = $maxOccupy;
            return $this;
        }

        /**
         * Get max_occupy
         *
         * @return integer
         */
        public function getMaxOccupy()
        {
            return $this->max_occupy;
        }

        /**
         * Set photo
         *
         * @param string $photo
         * @return Quarters
         */
        public function setPhoto($photo)
        {
            $this->photo = $photo;
            return $this;
        }

        /**
         * Get photo
         *
         * @return string
         */
        public function getPhoto()
        {
            return $this->photo;
        }

        /**
         * Set created
         *
         * @param datetime $created
         * @return Quarters
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
         * @return Quarters
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
         * @return Quarters
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
         * Set facility
         *
         * @param Scss\FacilityBundle\Entity\Facility $facility
         * @return Quarters
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
         * Set name
         *
         * @param string $name
         * @return Quarters
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
    }