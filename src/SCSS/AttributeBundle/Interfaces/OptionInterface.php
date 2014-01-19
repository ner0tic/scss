<?php
namespace SCSS\AttributeBundle\Interfaces;

use SCSS\AttributeBundle\Entity\Attribute;
use SCSS\AttributeBundle\Entity\Option;

interface OptionInterface
{
    public function getName();

    public function getDescription();

    public function getAttributes();

    public function getAttribute($attribute);

    public function setName($name);

    public function setDescription($dec);

    public function setAttributes(array $attributes);

    public function addAttribute(Attribute $attribute);
}
