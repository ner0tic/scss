<?php
namespace SCSS\AttributeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use SCSS\AttributeBundle\Entity\Attribute;
use SCSS\AttributeBundle\Interfaces\OptionInterface;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="option")
 */
class Option implements OptionInterface
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
     * @ORM\OneToMany(targetEntity="Attribute", mappedBy="attribute")
     */
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
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

    public function setPublic(boolean $public)
    {
        return $this->isPublic($public);
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($attribute)
    {
        return $this->attributes->get($attribute);
    }

    public function hasAttribute($attribute)
    {
        return !$this->attributes->isEmpty();
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
     * Set attributes
     *
     * @param array $attributes attributes
     *
     * @return self
     */
    public function setAttributes(array $attributes)
    {
        if (! $attributes instanceof ArrayCollection) {
            $attributes = new ArrayCollection($attributes);
        }

        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add a attribute
     *
     * @param Attribute $attribute attribute
     *
     * @return self
     */
    public function addAttribute(Attribute $attribute)
    {
        $this->attributes->add($attribute);

        return $this;
    }

    /**
     * Remove a attribute
     *
     * @param Attribute|String $attribute attribute
     *
     * @return self
     */
    public function removeAttribute($attribute)
    {
        $this->attributes->remove($attribute);

        return $this;
    }
}
