<?php
namespace SCSS\PasselBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use SCSS\UtilityBundle\Traits\SluggableTrait;

use SCSS\UtilityBundle\Traits\TimestampableTrait;
use SCSS\UserBundle\Entity\User;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="passel_leader")
 * @UniqueEntity(fields = "username", targetClass = "SCSS\UserBundle\Entity\User", message="fos_user.username_already")
 * @UniqueEntity(fields = "email", targetClass = "SCSS\UserBundle\Entity\User", message="fos_user.email_already")
 */
class Leader extends User
{
    use SluggableTrait;
    use TimestampableTrait;
    

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Passel", inversedBy="leader")
     * @ORM\JoinColumn(name="passel_id", referencedColumnName="id")
     */
    protected $passel = '';

    /**
     * Get passel
     *
     * @return Passel
     */
    public function getPassel()
    {
        return $this->passel;
    }

    /**
     * Set passel
     *
     * @param Passel $passel passel
     *
     * @return Leader
     */
    public function setPassel(Passel $passel)
    {
        $this->passel = $passel;

        return $this;
    }

    /**
     * Admin - if true, user can make limited changes to the passel
     * @var boolean
     */
    protected $admin = false;

    /**
     * Is admin
     *
     * @param boolean $admin admin
     *
     * @return boolean|Leader
     */
    public function isAdmin($admin = null)
    {
        if (null != $admin) {
            $this->admin = $admin;

            return $this;
        }

        return $thus->admin;
    }

    /**
     * Primary
     * @var boolean
     */
    protected $primary = false;

    /**
     * Is primary
     *
     * @param boolean $primary primary
     *
     * @return boolean|Leader
     */
    public function isPrimary($primary = null)
    {
        if (null != $primary) {
            $this->primary = $primary;

            return $this;
        }

        return $this->primary;
    }
}
