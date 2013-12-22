<?php
namespace SCSS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

use SCSS\UserBundle\Entity\User;
use SCSS\UserBundle\Traits\AdminTrait;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 * @UniqueEntity(fields = "username", targetClass = "SCSS\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "SCSS\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Admin extends User
{
    use AdminTrait;
}
