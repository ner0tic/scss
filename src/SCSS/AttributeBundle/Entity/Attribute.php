<?php
namespace SCSS\AttributeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use SCSS\AttributeBundle\Entity\Option;
use SCSS\AttributeBundle\Entity\Group;
use SCSS\AttributeBundle\Interfaces\AttributeInterface;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute")
 */
class Attribute implements AttributeInterface
{
    use SluggableTrait;
    use TimestampableTrait;
    

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="String")
     */
    protected $name;

    /**
     * @ORM\Column(name="description", type="text")
     * @Assert\Length(
     *      min = "1",
     *      max = "250",
     *      minMessage = "Name must be at least {{ limit }} characters length",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters length"
     * )
     * @var string
     */
    protected $description;

    /**
     * @ORM\Column(name="public", type="boolean")
     */
    protected $public = true;

    /**
     * @ORM\OneToMany(targetEntity="Option", mappedBy="option")
     */
    protected $options;

    /**
     * @ORM\OneToMany(targetEntity="Group", mappedBy="group")
     */
    protected $groups;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->groups = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isPublic($public = null)
    {
        if (null != $public) {
            $this->public = $public;

            return $this;
        }

        return $this->public;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getOption($option)
    {
        return ($this->hasOption($option)) ? $this->options[$option] : false;
    }

    public function hasOption($option)
    {
        return in_array($option, $this->options);
    }

    public function getGroups()
    {
        return $this->gropus;
    }

    public function getGroup($group)
    {
        return ($this->inGroup($group)) ? $this->groups[$group] : false;
    }

    public function inGroup($group)
    {
        return in_array($group, $this->groups);
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;

        return $this;
    }

    /**
     * Set options
     *
     * @param array $options options
     *
     * @return self
     */
    public function setOptions(array $options)
    {
        if (! $options instanceof ArrayCollection) {
            $options = new ArrayCollection($options);
        }

        $this->options = $options;

        return $this;
    }

    /**
     * Add a option
     *
     * @param Option $option option
     *
     * @return self
     */
    public function addOption(Option $option)
    {
        $this->options->add($option);

        return $this;
    }

    /**
     * Set groups
     *
     * @param array $groups groups
     *
     * @return self
     */
    public function setGroups(array $groups)
    {
        if (! $groups instanceof ArrayCollection) {
            $groups = new ArrayCollection($groups);
        }

        $this->groups = $groups;

        return $this;
    }

    /**
     * Add a group
     *
     * @param Group $group group
     *
     * @return self
     */
    public function addGroup(Group $group)
    {
        $this->groups->add($group);

        return $this;
    }

    /**
     * Remove a option
     *
     * @param Option|String $option option
     *
     * @return self
     */
    public function removeOption($option)
    {
        $this->options->remove($option);

        return $this;
    }

    /**
     * Remove a group
     *
     * @param Group|String $group group
     *
     * @return self
     */
    public function removeGroup($group)
    {
        $this->groups->remove($group);

        return $this;
    }
}
