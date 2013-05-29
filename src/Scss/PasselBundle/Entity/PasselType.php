<?php
    namespace Scss\PasselBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo,
        Symfony\Component\Validator\Constraints as Assert,
        Scss\PasselBundle\Entity\Passel;

    /**
     * @ORM\Table(name="passel_type")
     * @ORM\Entity(repositoryClass="Scss\PasselBundle\Repository\PasselTypeRepository")
     */
    class PasselType 
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;

        /**
         * @ORM\Column(type="string")
         * @Assert\MaxLength(250)
         */
        protected $name;
      
        /**
         * @ORM\Column(type="text")
         */
        protected $description;

        /**
         * @ORM\Column(type="string")
         * @Assert\MaxLength(3) 
         */
        protected $iso_code;

        /**
         * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Organization", inversedBy="rank")
         * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
         */      
        protected $organization;
      
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
         * @ORM\Column(unique=true)
         * @Assert\MaxLength(128)
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
         * @return GroupType
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
         * Set description
         *
         * @param text $description
         * @return GroupType
         */
        public function setDescription($description)
        {
            $this->description = $description;
            return $this;
        }

        /**
         * Get description
         *
         * @return text 
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set iso_code
         *
         * @param string $isoCode
         * @return GroupType
         */
        public function setIsoCode($isoCode)
        {
            $this->iso_code = $isoCode;
            return $this;
        }

        /**
         * Get iso_code
         *
         * @return string 
         */
        public function getIsoCode()
        {
            return $this->iso_code;
        }

        /**
         * Set created
         *
         * @param datetime $created
         * @return GroupType
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
         * @return GroupType
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
         * @return GroupType
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
    }