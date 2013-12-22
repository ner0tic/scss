<?php
namespace SCSS\CourseBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use SCSS\CourseBundle\Traits\WeekTrait;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="SCSS\CourseBundle\Repository\WeekRepository")
 * @ORM\Table(name="week")
 */
class Week
{
    use SluggableTrait;
    use TimestampableTrait;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->s = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Name
     * @var  string name
     * @ORM\Column(name="name", type="string")
     */
    protected $name = '';

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="SCSS\FacilityBundle\Entity\Facility", inversedBy="week")
     * @ORM\JoinColumn(name="facility_id", referencedColumnName="id")
     */
    protected $facility;

    public function getFacility()
    {
        return $this->facility;
    }

    /**
     * Set Facility
     *
     * @param  Facility $facility facility
     * @return Week
     */
    public function setFacility(Facility $facility)
    {
        $this->facility = $facility;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="Period", mappedBy="week")
     */
    protected $periods;

     /**
     * Get periods
     *
     * @return ArrayCollection
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * Set periods
     *
     * @param array $periods periods
     *
     * @return self
     */
    public function setPeriods(array $periods)
    {
        if (! $periods instanceof ArrayCollection) {
            $periods = new ArrayCollection($periods);
        }

        $this->periods = $periods;

        return $this;
    }

    /**
     * Has periods
     *
     * @return boolean
     */
    public function hasPeriods()
    {
        return !$this->periods->isEmpty();
    }

    /**
     * Get an period
     *
     * @param Period|String $period period
     *
     * @return Period
     */
    public function getPeriod($period)
    {
        return $this->periods->get($period);
    }

    /**
     * Add an period
     *
     * @param Period $period period
     *
     * @return self
     */
    public function addPeriod(Period $period)
    {
        $this->periods->add($period);

        return $this;
    }

    /**
     * Remove an period
     *
     * @param Period|String $period period
     *
     * @return self
     */
    public function removePeriod($period)
    {
        $this->periods->remove($period);

        return $this;
    }

    /**
     * @ORM\Column(type="date")
     */
    protected $start;

    /**
     * Get date
     *
     * @param  string $format format
     * @return string
     */
    public function getStart($format = 'M/d/Y')
    {
        return date($format, $this->start);
    }

    /**
     * Set start
     *
     * @param  DateTime $start start
     * @return Week
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @ORM\Column(type="date")
     */
    protected $end;

    /**
     * Get date
     *
     * @param  string $format format
     * @return string
     */
    public function getEnd($format = 'M/d/Y')
    {
        return date($format, $this->end);
    }

    /**
     * Set end
     *
     * @param  DateTime $end end
     * @return Week
     */
    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    protected $special;

    /**
     * Is special
     *
     * @param boolean $special special
     *
     * @return Week
     */
    public function isSpecial($special = null)
    {
        if (null != $special) {
            $this->special = $special;

            return $this;
        }

        return $this->special;
    }
}
