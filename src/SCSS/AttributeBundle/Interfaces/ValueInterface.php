<?php
namespace SCSS\AttributeBundle\Interfaces;

use SCSS\AttributeBundle\Entity\Attribute;
use SCSS\AttributeBundle\Entity\Option;

interface ValueInterface
{
    public function getName();

    public function getValue();

    public function getOptions();

    public function getOption($option);

    public function setName($name);

    public function setValue($value);

    public function setOptions(array $options);

    public function addOption(Option $option);
}
