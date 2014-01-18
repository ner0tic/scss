<?php
namespace SCSS\AttribUtebundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use SCSS\AttribUtebundle\Entity\Option;
use SCSS\AttributeBundle\Interfaces\ValueInterface;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="value")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "value" = "Value",
 *     "inputValue" = "InputValue"
 * }
 */
class Value implements ValueInterface
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
     * @ORM\Column(name="value", type="text")
     * 
     * @var string
     */
    protected $value;

    /**
     * @ORM\Column(name="public", type="boolean")
     */
    protected $public = true;

    /**
     * @ORM\OneToMany(targetEntity="Option", mappedBy="option")
     */
    protected $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
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

    public function getValue()
    {
        return $this->value;
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

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

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
}
