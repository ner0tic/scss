<?php
namespace SCSS\AttributeBundle\Interfaces;

use SCSS\AttributeBundle\Entity\Attribute;
use SCSS\AttributeBundle\Entity\Value;

interface ValueInterface
{
    public function getName();

    public function getDescription();

    public function getValues();

    public function getValue($value);

    public function getOptions();

    public function getOption($option);

    public function setName($name);

    public function setDescription($dec);

    public function setValues($values);

    public function addValue(Value $value);

    public function setOptions($options);

    public function addOption(Option $option);
}
