<?php
    namespace Scss\UserBundle\Entity;

    use FOS\UserBundle\Entity\User as BaseUser,
        Gedmo\Mapping\Annotation as Gedmo,
        Doctrine\ORM\Mapping as ORM,
        Symfony\Component\Validator\Constraints as Assert,
        Scss\EnrollmentBundle\Entity\ActiveEnrollment;

    /**
     * @ORM\Entity
     * @ORM\Table(name="fos_user")
     * @ORM\InheritanceType("JOINED")
     * @ORM\DiscriminatorColumn(name="type",type="string")
     * @ORM\DiscriminatorMap({"attendee" = "Scss\PasselBundle\Entity\Attendee", "passel_leader" = "Scss\PasselBundle\Entity\PasselLeader", "faculty"= "Scss\FacilityBundle\Entity\Faculty"})
     */
    abstract class User extends BaseUser
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
        
        /**
         * @ORM\Column(type="string") 
         * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
         * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
         * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
         */
        protected $first_name;
        
        /**
         * @ORM\Column(type="string") 
         * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
         * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
         * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
         */
        protected $last_name;
        
        /**
         * @var datetime $created
         *
         * @Gedmo\Timestampable(on="create")
         * @ORM\Column(type="datetime", nullable=true)
         */
        protected $created;

        /**
         * @var datetime $updated
         *
         * @Gedmo\Timestampable(on="update")
         * @ORM\Column(type="datetime", nullable=true)
         */
        protected $updated;    

        /**
         * @var string
         *
         * @ORM\Column(name="facebookId", type="string", length=255, nullable=true)
         */
        protected $facebookId;

        /**
         * @var string
         *
         * @ORM\Column(name="googleId", type="string", length=255, nullable=true)
         */
        protected $googleId;    
        
        /**
         * @var string
         *
         * @ORM\Column(name="linkedinId", type="string", length=255, nullable=true)
         */
        protected $linkedinId;
        
        /**
         * @var string
         *
         * @ORM\Column(name="twitterId", type="string", length=255, nullable=true)
         */
        protected $twitterId;    
        
        /**
         * @var string
         *
         * @ORM\Column(name="foursquareId", type="string", length=255, nullable=true)
         */
        protected $foursquareId;    
        
        /**
         * @ORM\ManyToOne(targetEntity="Scss\EnrollmentBundle\Entity\PasselEnrollment", inversedBy="user")
         * @ORM\JoinColumn(name="active_enrollment_id", referencedColumnName="id", nullable=true)
         */        
        protected $active_enrollment;    
        
        /**
         * @var string
         * 
         * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
         */
        protected $avatar = '/images/avatars/default.png';
        
        /**
         * Get the full name of the user (first + last name)
         * @return string
         */
        public function getFullName()
        {
            return $this->getFirstName() . ' ' . $this->getLastname();
        }

        /**
         * @param string $facebookId
         * @return void
         */
        public function setFacebookId($facebookId)
        {
            $this->facebookId = $facebookId;
            $this->setUsername($facebookId);
            $this->salt = '';
        }

        /**
         * @return string
         */
        public function getFacebookId()
        {
            return $this->facebookId;
        }

        /**
         * @param Array
         */
        public function setFBData($fbdata)
        {
            if (isset($fbdata['id'])) {
                $this->setFacebookId($fbdata['id']);
                $this->addRole('ROLE_FACEBOOK');
            }
            if (isset($fbdata['first_name'])) {
                $this->setFirstName($fbdata['first_name']);
            }
            if (isset($fbdata['last_name'])) {
                $this->setLastName($fbdata['last_name']);
            }
            if (isset($fbdata['email'])) {
                $this->setEmail($fbdata['email']);
            }
        }
        
        public function __construct()
        {
            parent::__construct();
            // your own logic
        }

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
         * @param string $firstName
         * @return User
         */
        public function setFirstName($firstName)
        {
            $this->first_name = $firstName;
            return $this;
        }

        /**
         * Get first_name
         *
         * @return string 
         */
        public function getFirstName()
        {
            return $this->first_name;
        }

        /**
         * Set last_name
         *
         * @param string $lastName
         * @return User
         */
        public function setLastName($lastName)
        {
            $this->last_name = $lastName;
            return $this;
        }

        /**
         * Get last_name
         *
         * @return string 
         */
        public function getLastName()
        {
            return $this->last_name;
        }

        /**
         * Set created
         *
         * @param datetime $created
         * @return User
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
         * @return User
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
         * Set active_enrollment
         *
         * @param Scss\EnrollmentBundle\Entity\PasselEnrollment $activeEnrollment
         * @return User
         */
        public function setActiveEnrollment(ActiveEnrollment $activeEnrollment = null)
        {
            $this->active_enrollment = $activeEnrollment;
            return $this;
        }

        /**
         * Get active_enrollment
         *
         * @return Scss\EnrollmentBundle\Entity\PasselEnrollment 
         */
        public function getActiveEnrollment()
        {
            return $this->active_enrollment;
        }

        /**
         * Set googleId
         *
         * @param string $googleId
         * @return User
         */
        public function setGoogleId($googleId)
        {
            $this->googleId = $googleId;
            return $this;
        }

        /**
         * Get googleId
         *
         * @return string 
         */
        public function getGoogleId()
        {
            return $this->googleId;
        }

        /**
         * Set linkedinId
         *
         * @param string $linkedinId
         * @return User
         */
        public function setLinkedinId($linkedinId)
        {
            $this->linkedinId = $linkedinId;
            return $this;
        }

        /**
         * Get linkedinId
         *
         * @return string 
         */
        public function getLinkedinId()
        {
            return $this->linkedinId;
        }

        /**
         * Set twitterId
         *
         * @param string $twitterId
         * @return User
         */
        public function setTwitterId($twitterId)
        {
            $this->twitterId = $twitterId;
            return $this;
        }

        /**
         * Get twitterId
         *
         * @return string 
         */
        public function getTwitterId()
        {
            return $this->twitterId;
        }

        /**
         * Set foursquareId
         *
         * @param string $foursquareId
         * @return User
         */
        public function setFoursquareId($foursquareId)
        {
            $this->foursquareId = $foursquareId;
            return $this;
        }

        /**
         * Get foursquareId
         *
         * @return string 
         */
        public function getFoursquareId()
        {
            return $this->foursquareId;
        }

        /**
         * Set avatar
         *
         * @param string $avatar
         * @return User
         */
        public function setAvatar($avatar)
        {
            $this->avatar = $avatar;
            return $this;
        }

        /**
         * Get avatar
         *
         * @return string 
         */
        public function getAvatar()
        {
            return $this->avatar;
        }
    }
