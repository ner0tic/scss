<?php
namespace SCSS\AttribUtebundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

use SCSS\UtilityBundle\Traits\BlameableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="input_value")
 */
class InputValue extends Value
{
    use BlameableTrait;
}
