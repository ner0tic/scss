<?php
namespace SCSS\FacilityBundle\Traits;

trait FacultyTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Position", inversedBy="faculty")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    protected $position;

    /**
     * Get position
     *
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set position
     *
     * @param Position $position position
     *
     * @return Leader
     */
    public function setPosition(Position $position)
    {
        $this->position = $position;

        return $this;
    }

    protected $facility;

    /**
     * Get facility
     *
     * @return Facility
     */
    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set facility
     *
     * @param Facility $facility facility
     *
     * @return Leader
     */
    public function setFacility(Facility $facility)
    {
        $this->facility = $facility;

        return $this;
    }

    protected $quarters;

    /**
     * Get quarters
     *
     * @return Quarters
     */
    public function getQuarters($type)
    {
        return $this->quarters->filterByType($type);
    }

    /**
     * Set quarters
     *
     * @param Quarters $quarters quarters
     *
     * @return Faculty
     */
    public function setQuarters(Quarters $quarters)
    {
        $this->quarters = $quarters;

        return $this;
    }

    protected $quarters_types = array();

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
}
