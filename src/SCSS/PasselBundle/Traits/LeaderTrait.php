<?php
namespace SCSS\PasselBundle\Traits;

use SCSS\PasselBundle\Entity\Leader;

trait LeaderTrait
{
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
