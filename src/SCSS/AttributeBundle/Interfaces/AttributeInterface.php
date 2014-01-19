<?php
namespace SCSS\AttributeBundle\Interfaces;

use SCSS\AttributeBundle\Entity\Option;
use SCSS\AttributeBundle\Entity\Group;
use SCSS\AttributeBundle\Entity\

interface AttributeInterface
{
    public function getName();

    public function getDescription();

    public function getOptions();

    public function getGroups();

    public function setName($name);

    public function setDescription($desc);

    public function setOptions(array $options);

    public function addOption(Option $option);

    public function removeOption(Option $option);

    public function setGroups(array $groups);

    public function addGroup(Group $group);

    public function removeGroup(Group $group);
}
