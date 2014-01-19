<?php
namespace SCSS\AttributeBundle\Traits;

use Doctrine\Common\Collections\ArrayCollection;

trait HasAttributesTrait
{
    protected $attributes;

    protected $groups;

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($attribute)
    {
        return $this->attributes->get($atribute);
    }

    public function hasAttributes()
    {
        return !$this->attributes->isEmpty();
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getGroup($group)
    {
        return $this->groups->get($group);
    }

    public function hasGroups()
    {
        return !$this->groups->isEmpty();
    }

    public function setAttributes(array $attributes)
    {
        if (! $attributes instanceof ArrayCollection) {
            $attributes = new ArrayCollection($attributes);
        }

        $this->attributes = $attributes;

        return $this;
    }

    public function addAttribute(Attribute $attribute)
    {
        $this->attributes->add($attribute);

        return $this;
    }

    public function setGroups(array $groups)
    {
        if (! $groups instanceof ArrayCollection) {
            $groups = new ArrayCollection($groups);
        }

        $this->groups = $groups;

        return $this;
    }

    public function addGroup(Group $group)
    {
        $this->groups->add($group);

        return $this;
    }

    public function removeAttribute(Attribute $attribute)
    {
        $this->attributes->remove($attribute);

        return $this;
    }

    public function removeGroup(Group $group)
    {
        $this->groups->remove($group);

        return $this;
    }
}
