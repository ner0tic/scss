<?php
namespace SCSS\FacilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use SCSS\FacilityBundle\Traits\FacilityTrait;
use SCSS\UtilityBundle\Traits\SluggableTrait;

use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="facility")
 */
class Facility
{
    use SluggableTrait;
    
    use TimestampableTrait;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Name
     * @var  string name
     * @ORM\Column(name="name", type="string")
     */
    protected $name = '';

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
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\UserBundle\Entity\AddressBook", inversedBy="facility")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

    /**
     * Get address
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param Address $address address
     *
     * @return Facility
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Organization", inversedBy="facility")
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
     * @return Facility
     */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Council", inversedBy="facility")
     * @ORM\JoinColumn(name="council_id", referencedColumnName="id")
     */
    protected $council;

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
     * @return Leader
     */
    public function setCouncil(Council $council)
    {
        $this->council = $council;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Region", inversedBy="facility")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    protected $region;

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
     * @return Leader
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Faculty", mappedBy="facility")
     */
    protected $faculty;

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
     * Get an faculty
     *
     * @param Faculty|String $faculty faculty
     *
     * @return Faculty
     */
    public function getFaculty($faculty = null)
    {
        if (null == $faculty) {
            return $this->faculty;
        }
        
        return $this->faculty->get($faculty);
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

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Quarters", inversedBy="facility")
     * @ORM\JoinColumn(name="quarters_id", referencedColumnName="id")
     */
    protected $quarters;

    /**
     * @param string $type type
     */
    public function getQuarters($type = null)
    {
        if (null != $type) {
            return $this->quarters->filterByType($type);
        }

        return $this->quarters;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Department", inversedBy="facility")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $departments;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Department", inversedBy="department")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $seasons;

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
}
