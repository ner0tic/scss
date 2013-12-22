<?php
namespace SCSS\OrganizationBundle\Traits;

trait OrganizationTrait
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = "1",
     *      max = "250",
     *      minMessage = "Name must be at least {{ limit }} characters length",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters length"
     * )
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
     * @ORM\Column(type="text")
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
     * @return Organization
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Type", mappedBy="organization")
     */
    protected $types;

    /**
     * Get types
     *
     * @return ArrayCollection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set types
     *
     * @param array $types types
     *
     * @return self
     */
    public function setTypes(array $types)
    {
        if (! $types instanceof ArrayCollection) {
            $types = new ArrayCollection($types);
        }

        $this->types = $types;

        return $this;
    }

    /**
     * Has types
     *
     * @return boolean
     */
    public function hasTypes()
    {
        return !$this->types->isEmpty();
    }

    /**
     * Get an type
     *
     * @param Type|String $type type
     *
     * @return Type
     */
    public function getType($type)
    {
        return $this->types->get($type);
    }

    /**
     * Add an type
     *
     * @param Type $type type
     *
     * @return self
     */
    public function addType(Type $type)
    {
        $this->types->add($type);

        return $this;
    }

    /**
     * Remove an type
     *
     * @param Type|String $type type
     *
     * @return self
     */
    public function removeType($type)
    {
        $this->types->remove($type);

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Council", mappedBy="organization")
     */
    protected $councils;

    /**
     * Get councils
     *
     * @return ArrayCollection
     */
    public function getCouncils()
    {
        return $this->councils;
    }

    /**
     * Set councils
     *
     * @param array $councils councils
     *
     * @return self
     */
    public function setCouncils(array $councils)
    {
        if (! $councils instanceof ArrayCollection) {
            $councils = new ArrayCollection($councils);
        }

        $this->councils = $councils;

        return $this;
    }

    /**
     * Has councils
     *
     * @return boolean
     */
    public function hasCouncils()
    {
        return !$this->councils->isEmpty();
    }

    /**
     * Get an council
     *
     * @param Council|String $council council
     *
     * @return Council
     */
    public function getCouncil($council)
    {
        return $this->councils->get($council);
    }

    /**
     * Add an council
     *
     * @param Council $council council
     *
     * @return self
     */
    public function addCouncil(Council $council)
    {
        $this->councils->add($council);

        return $this;
    }

    /**
     * Remove an council
     *
     * @param Council|String $council council
     *
     * @return self
     */
    public function removeCouncil($council)
    {
        $this->councils->remove($council);

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Region", mappedBy="organization")
     */
    protected $regions;

    /**
     * Get regions
     *
     * @return ArrayCollection
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * Set regions
     *
     * @param array $regions regions
     *
     * @return self
     */
    public function setRegions(array $regions)
    {
        if (! $regions instanceof ArrayCollection) {
            $regions = new ArrayCollection($regions);
        }

        $this->regions = $regions;

        return $this;
    }

    /**
     * Has regions
     *
     * @return boolean
     */
    public function hasRegions()
    {
        return !$this->regions->isEmpty();
    }

    /**
     * Get an region
     *
     * @param Region|String $region region
     *
     * @return Region
     */
    public function getRegion($region)
    {
        return $this->regions->get($region);
    }

    /**
     * Add an region
     *
     * @param Region $region region
     *
     * @return self
     */
    public function addRegion(Region $region)
    {
        $this->regions->add($region);

        return $this;
    }

    /**
     * Remove an region
     *
     * @param Region|String $region region
     *
     * @return self
     */
    public function removeRegion($region)
    {
        $this->regions->remove($region);

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Passel", mappedBy="organization")
     */
    protected $passels;

    /**
     * Get passels
     *
     * @return ArrayCollection
     */
    public function getPassels()
    {
        return $this->passels;
    }

    /**
     * Set passels
     *
     * @param array $passels passels
     *
     * @return self
     */
    public function setPassels(array $passels)
    {
        if (! $passels instanceof ArrayCollection) {
            $passels = new ArrayCollection($passels);
        }

        $this->passels = $passels;

        return $this;
    }

    /**
     * Has passels
     *
     * @return boolean
     */
    public function hasPassels()
    {
        return !$this->passels->isEmpty();
    }

    /**
     * Get an passel
     *
     * @param Passel|String $passel passel
     *
     * @return Passel
     */
    public function getPassel($passel)
    {
        return $this->passels->get($passel);
    }

    /**
     * Add an passel
     *
     * @param Passel $passel passel
     *
     * @return self
     */
    public function addPassel(Passel $passel)
    {
        $this->passels->add($passel);

        return $this;
    }

    /**
     * Remove an passel
     *
     * @param Passel|String $passel passel
     *
     * @return self
     */
    public function removePassel($passel)
    {
        $this->passels->remove($passel);

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Facility", mappedBy="organization")
     */
    protected $facilities;

    /**
     * Get facilities
     *
     * @return ArrayCollection
     */
    public function getFacilities()
    {
        return $this->facilities;
    }

    /**
     * Set facilities
     *
     * @param array $facilities facilities
     *
     * @return self
     */
    public function setFacilities(array $facilities)
    {
        if (! $facilities instanceof ArrayCollection) {
            $facilities = new ArrayCollection($facilities);
        }

        $this->facilities = $facilities;

        return $this;
    }

    /**
     * Has facilities
     *
     * @return boolean
     */
    public function hasFacilities()
    {
        return !$this->facilities->isEmpty();
    }

    /**
     * Get an facility
     *
     * @param Facility|String $facility facility
     *
     * @return Facility
     */
    public function getFacility($facility)
    {
        return $this->facilities->get($facility);
    }

    /**
     * Add an facility
     *
     * @param Facility $facility facility
     *
     * @return self
     */
    public function addFacility(Facility $facility)
    {
        $this->facilities->add($facility);

        return $this;
    }

    /**
     * Remove an facility
     *
     * @param Facility|String $facility facility
     *
     * @return self
     */
    public function removeFacility($facility)
    {
        $this->facilities->remove($facility);

        return $this;
    }

        /**
     * @ORM\OneToMany(targetEntity="Faculty", mappedBy="organization")
     */
    protected $facultys;

    /**
     * Get facultys
     *
     * @return ArrayCollection
     */
    public function getFacultys()
    {
        return $this->facultys;
    }

    /**
     * Set facultys
     *
     * @param array $facultys facultys
     *
     * @return self
     */
    public function setFacultys(array $facultys)
    {
        if (! $facultys instanceof ArrayCollection) {
            $facultys = new ArrayCollection($facultys);
        }

        $this->facultys = $facultys;

        return $this;
    }

    /**
     * Has facultys
     *
     * @return boolean
     */
    public function hasFacultys()
    {
        return !$this->facultys->isEmpty();
    }

    /**
     * Get an faculty
     *
     * @param Faculty|String $faculty faculty
     *
     * @return Faculty
     */
    public function getFaculty($faculty)
    {
        return $this->facultys->get($faculty);
    }

    /**
     * Add an faculty
     *
     * @param Faculty $faculty faculty
     *
     * @return self
     */
    public function addFaculty(Faculty $faculty)
    {
        $this->facultys->add($faculty);

        return $this;
    }

    /**
     * Remove an faculty
     *
     * @param Faculty|String $faculty faculty
     *
     * @return self
     */
    public function removeFaculty($faculty)
    {
        $this->facultys->remove($faculty);

        return $this;
    }
}
