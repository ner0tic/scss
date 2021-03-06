
<?php
namespace SCSS\FacilityBundle\Traits;

trait QuartersTrait
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
    * @ORM\Column(type="string", length=150)
    * @var type
    */
    protected $name;

    /**
     * Set name
     *
     * @param  string   $name
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

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $type;

    /**
     * Set type
     *
     * @param  string   $type
     * @return Quarters
     */
    public function setType($type)
    {
        if (!in_array($type,$this->_types)) {
          return false;
        }

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
     * @ORM\Column(type="integer")
     */
    protected $capacity;

    /**
     * Set capacity
     *
     * @param  integer  $capacity
     * @return Quarters
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Facility", inversedBy="quarters")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;

    /**
     * Set facility
     *
     * @param  SCSS\FacilityBundle\Entity\Facility $facility
     * @return Quarters
     */
    public function setFacility(Facility $facility = null)
    {
        $this->facility = $facility;

        return $this;
    }

    /**
     * Get facility
     *
     * @return SCSS\FacilityBundle\Entity\Facility
     */
    public function getFacility()
    {
        return $this->facility;
    }
}
