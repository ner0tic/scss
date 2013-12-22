<?php
namespace SCSS\OrganizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="region")
 */
class Region
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
     * @return Region
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="SCSS\PasselBundle\Entity\Passel", mappedBy="region")
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
    public function addPassel(SCSS\PasselBundle\Entity\Passel $passel)
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
     * @ORM\OneToMany(targetEntity="SCSS\FacilityBundle\Entity\Facility", mappedBy="region")
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
    public function addFacility(SCSS\FacilityBundle\Entity\Facility $facility)
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
     * @ORM\OneToMany(targetEntity="SCSS\FacilityBundle\Entity\Faculty", mappedBy="region")
     */
    protected $faculty;

    /**
     * Get faculty
     *
     * @param  string|Faculty  $faculty faculty
     * @return ArrayCollection
     */
    public function getFaculty($faculty = null)
    {
        if (null != $faculty) {
            return $this->faculty->get($faculty);
        }

        return $this->faculty;
    }

    /**
     * Set faculty
     *
     * @param array $faculty faculty
     *
     * @return self
     */
    public function setFaculty(array $faculty)
    {
        if (! $faculty instanceof ArrayCollection) {
            $faculty = new ArrayCollection($faculty);
        }

        $this->faculty = $faculty;

        return $this;
    }

    /**
     * Has faculty
     *
     * @return boolean
     */
    public function hasFaculty()
    {
        return !$this->faculty->isEmpty();
    }

    /**
     * Add an faculty
     *
     * @param Faculty $faculty faculty
     *
     * @return self
     */
    public function addFaculty(SCSS\FacilityBundle\Entity\Faculty $faculty)
    {
        $this->faculty->add($faculty);

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
        $this->faculty->remove($faculty);

        return $this;
    }
}
