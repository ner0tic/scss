<?php
    namespace Scss\CourseBundle\Entity;

    use Doctrine\ORM\Mapping as ORM,
        Gedmo\Mapping\Annotation as Gedmo;

    /**
     * @ORM\Entity
     * @ORM\Table(name="scss_class")
     */
    class ScssClass {

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
       * @ORM\ManyToOne(targetEntity="Course", inversedBy="scss_class")
       * @ORM\JoinColumn(name="course_id", referencedColumnName="id")
       */       
      protected $course;

      /**
       * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Faculty", inversedBy="scss_class")
       * @ORM\JoinColumn(name="faculty_id", referencedColumnName="id")
       */         
      protected $faculty;

      /**
       * @ORM\ManyToOne(targetEntity="Scss\FacilityBundle\Entity\Department", inversedBy="scss_class")
       * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
       */         
      protected $department;

      /**
       * @ORM\ManyToOne(targetEntity="Period", inversedBy="scss_class")
       * @ORM\JoinColumn(name="period_id", referencedColumnName="id")
       */         
      protected $period;

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
         * @return ScssClass
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
         * @return ScssClass
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
         * @return ScssClass
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
         * @return ScssClass
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
         * Set course
         *
         * @param Scss\CourseBundle\Entity\Course $course
         * @return ScssClass
         */
        public function setCourse(\Scss\CourseBundle\Entity\Course $course = null)
        {
            $this->course = $course;
            return $this;
        }

        /**
         * Get course
         *
         * @return Scss\CourseBundle\Entity\Course 
         */
        public function getCourse()
        {
            return $this->course;
        }

        /**
         * Set faculty
         *
         * @param Scss\FacilityBundle\Entity\Faculty $faculty
         * @return ScssClass
         */
        public function setFaculty(\Scss\FacilityBundle\Entity\Faculty $faculty = null)
        {
            $this->faculty = $faculty;
            return $this;
        }

        /**
         * Get faculty
         *
         * @return Scss\FacilityBundle\Entity\Faculty 
         */
        public function getFaculty()
        {
            return $this->faculty;
        }

        /**
         * Set department
         *
         * @param Scss\FacilityBundle\Entity\Department $department
         * @return ScssClass
         */
        public function setDepartment(\Scss\FacilityBundle\Entity\Department $department = null)
        {
            $this->department = $department;
            return $this;
        }

        /**
         * Get department
         *
         * @return Scss\FacilityBundle\Entity\Department 
         */
        public function getDepartment()
        {
            return $this->department;
        }

        /**
         * Set period
         *
         * @param Scss\CourseBundle\Entity\Period $period
         * @return ScssClass
         */
        public function setPeriod(\Scss\CourseBundle\Entity\Period $period = null)
        {
            $this->period = $period;
            return $this;
        }

        /**
         * Get period
         *
         * @return Scss\CourseBundle\Entity\Period 
         */
        public function getPeriod()
        {
            return $this->period;
        }
    }