<?php
    namespace Scss\FacilityBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo;


    /**
     * @ORM\Entity
     * @ORM\Table(name="facility")
     */
    class Facility 
    {
      /**
       * @ORM\Id
       * @ORM\Column(type="integer")
       * @ORM\GeneratedValue(strategy="AUTO")
       */
      protected $id;

        /**
         * @Gedmo\Slug(fields={"name"}) 
         * @ORM\Column(length=128, unique=true)
         */
        protected $slug;
        
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
         * @ORM\Column(type="string", length=150)
         * @var type 
         */
        protected $name;
        
        /**
         * @ORM\Column(type="string", length=15, nullable=true)
         * @var type 
         */
        protected $phone;
        
        /**
         * @ORM\Column(type="string", length=15, nullable=true)
         * @var type 
         */
        protected $fax;
        
        /**
         * @ORM\Column(type="string", length=250, nullable=true)
         * @var type 
         */
        protected $url;
        
        /**
         * @ORM\Column(type="string", length=150, nullable=true)
         * @var type 
         */
        protected $email;
        
        /**
         * @ORM\OneToMany(targetEntity="Faculty", mappedBy="facility")
         */
        protected $faculty;

        /**
         * @ORM\OneToMany(targetEntity="Quarters", mappedBy="facility")
         */    
        protected $quarters;
        
        /**
         * @ORM\OneToMany(targetEntity="Scss\UserBundle\Entity\AddressBook", mappedBy="facility")
         */    
        protected $address;    
        
        /**
         * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Region", inversedBy="facility")
         * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
         */    
        protected $region;
        
        /**
         * @ORM\OneToMany(targetEntity="Department", mappedBy="facility")
         */    
        protected $departments;
          

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
         * @return Facility
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
         * Set created
         *
         * @param datetime $created
         * @return Facility
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
         * @return Facility
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
         * Set name
         *
         * @param string $name
         * @return Facility
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
         * Set phone
         *
         * @param string $phone
         * @return Facility
         */
        public function setPhone($phone)
        {
            $this->phone = $phone;
            return $this;
        }

        /**
         * Get phone
         *
         * @return string 
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * Set fax
         *
         * @param string $fax
         * @return Facility
         */
        public function setFax($fax)
        {
            $this->fax = $fax;
            return $this;
        }

        /**
         * Get fax
         *
         * @return string 
         */
        public function getFax()
        {
            return $this->fax;
        }

        /**
         * Set url
         *
         * @param string $url
         * @return Facility
         */
        public function setUrl($url)
        {
            $this->url = $url;
            return $this;
        }

        /**
         * Get url
         *
         * @return string 
         */
        public function getUrl()
        {
            return $this->url;
        }

        /**
         * Set email
         *
         * @param string $email
         * @return Facility
         */
        public function setEmail($email)
        {
            $this->email = $email;
            return $this;
        }

        /**
         * Get email
         *
         * @return string 
         */
        public function getEmail()
        {
            return $this->email;
        }
        public function __construct()
        {
            $this->faculty = new \Doctrine\Common\Collections\ArrayCollection();
            $this->quarters = new \Doctrine\Common\Collections\ArrayCollection();
            $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
        }
        
        /**
         * Add faculty
         *
         * @param Scss\FacilityBundle\Entity\Faculty $faculty
         * @return Facility
         */
        public function addFaculty(\Scss\FacilityBundle\Entity\Faculty $faculty)
        {
            $this->faculty[] = $faculty;
            return $this;
        }

        /**
         * Get faculty
         *
         * @return Doctrine\Common\Collections\Collection 
         */
        public function getFaculty()
        {
            return $this->faculty;
        }

        /**
         * Add quarters
         *
         * @param Scss\FacilityBundle\Entity\Quarters $quarters
         * @return Facility
         */
        public function addQuarters(\Scss\FacilityBundle\Entity\Quarters $quarters)
        {
            $this->quarters[] = $quarters;
            return $this;
        }

        /**
         * Get quarters
         *
         * @return Doctrine\Common\Collections\Collection 
         */
        public function getQuarters()
        {
            return $this->quarters;
        }

        /**
         * Set region
         *
         * @param Scss\OrganizationBundle\Entity\Region $region
         * @return Facility
         */
        public function setRegion(\Scss\OrganizationBundle\Entity\Region $region = null)
        {
            $this->region = $region;
            return $this;
        }

        /**
         * Get region
         *
         * @return Scss\OrganizationBundle\Entity\Region 
         */
        public function getRegion()
        {
            return $this->region;
        }

        /**
         * Add departments
         *
         * @param Scss\FacilityBundle\Entity\Department $departments
         * @return Facility
         */
        public function addDepartments(\Doctrine\Common\Collections\Collection $departments)
        {
            $this->departments = array_merge($this->departments, $departments);
            return $this;
        }

        /**
         * Get departments
         *
         * @return Doctrine\Common\Collections\Collection 
         */
        public function getDepartments()
        {
            return $this->departments;
        }

        /**
         * Add departments
         *
         * @param Scss\FacilityBundle\Entity\Department $departments
         * @return Facility
         */
        public function addDepartment(\Scss\FacilityBundle\Entity\Department $department)
        {
            $this->departments[] = $department;
            return $this;
        }

        /**
         * Get department
         *
         */
        public function getDepartment($slug)
        {
          if(in_array($slug, $this->departments))  {
            foreach($this->departments as $dept) {
              if($dept->getSlug() == $slug) return $dept;
            }
          }
          return false;
        }

        /**
         * Get address
         *
         * @return Doctrine\Common\Collections\Collection 
         */
        public function getAddress()
        {
            return $this->address;
        }

        /**
         * Remove faculty
         *
         * @param Scss\FacilityBundle\Entity\Faculty $faculty
         */
        public function removeFaculty(\Scss\FacilityBundle\Entity\Faculty $faculty)
        {
            $this->faculty->removeElement($faculty);
        }

        /**
         * Add quarters
         *
         * @param Scss\FacilityBundle\Entity\Quarters $quarters
         * @return Facility
         */
        public function addQuarter(\Scss\FacilityBundle\Entity\Quarters $quarters)
        {
            $this->quarters[] = $quarters;
            return $this;
        }

        /**
         * Remove quarters
         *
         * @param Scss\FacilityBundle\Entity\Quarters $quarters
         */
        public function removeQuarter(\Scss\FacilityBundle\Entity\Quarters $quarters)
        {
            $this->quarters->removeElement($quarters);
        }

        /**
         * Add address
         *
         * @param Scss\UserBundle\Entity\AddressBook $address
         * @return Facility
         */
        public function addAddress(\Scss\UserBundle\Entity\AddressBook $address)
        {
            $this->address[] = $address;
            return $this;
        }

        /**
         * Remove address
         *
         * @param Scss\UserBundle\Entity\AddressBook $address
         */
        public function removeAddress(\Scss\UserBundle\Entity\AddressBook $address)
        {
            $this->address->removeElement($address);
        }

        /**
         * Remove departments
         *
         * @param Scss\FacilityBundle\Entity\Department $departments
         */
        public function removeDepartment(\Scss\FacilityBundle\Entity\Department $departments)
        {
            $this->departments->removeElement($departments);
        }
    }