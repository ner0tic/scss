<?php

namespace Scss\DBAL\Types\DataTypes;

class EnumQuartersType extends EnumType {
  protected $name = 'enumQuarters';
  protected $values = array('group', 'faculty');
}
