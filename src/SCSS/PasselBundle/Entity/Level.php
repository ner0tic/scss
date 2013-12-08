<?php
namespace SCSS\PasselBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SCSS\PasselBundle\Traits\LevelTrait;
use SCSS\PasselBundle\Traits\HasAttendeesTrait;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\BlameableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="SCSS\PasselBundle\Repository\LevelRepository")
 * @ORM\Table(name="attendee_level")
 */
class Level
{
    use HasAttendeesTrait;
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

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
     *
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
     * @ORM\ManyToOne(targetEntity="SCSS\OrganizationBundle\Entity\Organization", inversedBy="level")
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
     * @ORM\Column(type="boolean")
     */
    protected $special = false;

    /**
     * Is special
     *
     * @param boolean $special special
     *
     * @return Rank
     */
    public function isSpecial($special = null)
    {
        if (null != $special) {
            $this->special = $special;

            return $this;
        }

        return $this->special;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendees = new ArrayCollection();
    }
}
