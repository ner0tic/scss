<?php
namespace SCSS\CourseBundle\Entity;

use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;
use SCSS\UtilityBundle\Traits\BlameableTrait;

/**
 * @Entity(repositoryClass="SCSS\CourseBundle\Repository\CourseRepository")
 * @Table(name="course")
 */
class Course
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(region="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\Column(region="string")
     * @Assert\MaxLength(250)
     * @var string
     */
    protected $name;

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
     * Set name
     *
     * @param string $name name
     *
     * @return Passel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\Column(region="text")
     */
    protected $description;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description string
     *
     * @return Region
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Organization", inversedBy="course")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * Get organization
     *
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set organization
     *
     * @param Organization $organization organization
     *
     * @return Course
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Council", inversedBy="course")
     * @ORM\JoinColumn(name="council_id", referencedColumnName="id")
     */
    protected $council = null;

    /**
     * Get council
     *
     * @return Council
     */
    public function getCouncil()
    {
        return $this->council;
    }

    /**
     * Set council
     *
     * @param Council $council council
     *
     * @return Course
     */
    public function setCouncil(Council $council)
    {
        $this->council = $council;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Region", inversedBy="course")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    protected $region = null;

    /**
     * Get region
     *
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param Region $region region
     *
     * @return Course
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Type", inversedBy="course")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type = null;

    /**
     * Get type
     *
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param Type $type type
     *
     * @return Course
     */
    public function setType(Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Class", mappedBy="course")
     */
    protected $classes = array();

    /**
     * Get classes
     *
     * @return ArrayCollection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Set classes
     *
     * @param array $classes classes
     *
     * @return self
     */
    public function setClasses(array $classes)
    {
        if (! $classes instanceof ArrayCollection) {
            $classes = new ArrayCollection($classes);
        }

        $this->classes = $classes;

        return $this;
    }

    /**
     * Has classes
     *
     * @return boolean
     */
    public function hasClasses()
    {
        return !$this->classes->isEmpty();
    }

    /**
     * Get a class
     *
     * @param Class|String $class class
     *
     * @return Class
     */
    public function getClass($class)
    {
        return $this->classes->get($class);
    }

    /**
     * Add a class
     *
     * @param Class $class class
     *
     * @return self
     */
    public function addClass(Class $class)
    {
        $this->classes->add($class);

        return $this;
    }

    /**
     * Remove a class
     *
     * @param Class|String $class class
     *
     * @return self
     */
    public function removeClass($class)
    {
        $this->classes->remove($class);

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Requirement", mappedBy="course")
     */
    protected $requirements = array();

    /**
     * Get requirements
     *
     * @return ArrayCollection
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Set requirements
     *
     * @param array $requirements requirements
     *
     * @return self
     */
    public function setRequirements(array $requirements)
    {
        if (! $requirements instanceof ArrayCollection) {
            $requirements = new ArrayCollection($requirements);
        }

        $this->requirements = $requirements;

        return $this;
    }

    /**
     * Has requirements
     *
     * @return boolean
     */
    public function hasRequirements()
    {
        return !$this->requirements->isEmpty();
    }

    /**
     * Get a requirement
     *
     * @param Requirement|String $requirement requirement
     *
     * @return Requirement
     */
    public function getRequirement($requirement)
    {
        return $this->requirements->get($requirement);
    }

    /**
     * Add a requirement
     *
     * @param Requirement $requirement requirement
     *
     * @return self
     */
    public function addRequirement(Requirement $requirement)
    {
        $this->requirements->add($requirement);

        return $this;
    }

    /**
     * Remove a requirement
     *
     * @param Requirement|String $requirement requirement
     *
     * @return self
     */
    public function removeRequirement($requirement)
    {
        $this->requirements->remove($requirement);

        return $this;
    }
}