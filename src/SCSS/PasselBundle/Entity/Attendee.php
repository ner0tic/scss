<?php
namespace SCSS\PasselBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\BlameableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;
use SCSS\UserBundle\Entity\User;

/**
 * @ORM\Table(name="attendee")
 * @ORM\Entity(repositoryClass="SCSS\PasselBundle\Repository\LeaderRepository")
 */
class Attendee extends User
{
    use SluggableTrait;
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Passel", inversedBy="attendee")
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
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Faction", inversedBy="attendee")
     * @ORM\JoinColumn(name="faction_id", referencedColumnName="id")
     */
    protected $faction = '';

    /**
     * Get faction
     *
     * @return Faction
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Set faction
     *
     * @param Faction $faction faction
     *
     * @return Leader
     */
    public function setFaction(Faction $faction)
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Position", inversedBy="attendee")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    protected $position = '';

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

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\PasselBundle\Entity\Level", inversedBy="attendee")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    protected $level = '';

    /**
     * Get level
     *
     * @return Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set level
     *
     * @param Level $level level
     *
     * @return Leader
     */
    public function setLevel(Level $level)
    {
        $this->level = $level;

        return $this;
    }
}
