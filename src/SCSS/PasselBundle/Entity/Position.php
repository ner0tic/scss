<?php
namespace SCSS\PasselBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use SCSS\PasselBundle\Traits\HasAttendeesTrait;
use SCSS\UtilityBundle\Traits\SluggableTrait;

use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Table(name="passel_position")
 * @ORM\Entity(repositoryClass="SCSS\PasselBundle\Repository\PositionRepository")
 */
class Position
{
    use HasAttendeesTrait;
    use SluggableTrait;
    use TimestampableTrait;
    
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
     * Description
     * @var string
     */
    protected $description = '';

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
     * @param string $description description
     *
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Organization", inversedBy="position")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization = '';

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
      * @return  Organization
      */
    public function setOrganization(Organization $organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }
}
