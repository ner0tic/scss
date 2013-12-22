<?php
namespace SCSS\CourseBundle\Traits;

trait PeriodTrait
{
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
     * @ORM\ManyToOne(targetEntity="SCSS\CourseBundle\Entity\Week", inversedBy="period")
     * @ORM\JoinColumn(name="week_id", referencedColumnName="id")
     */
    protected $week;

    public function getWeek()
    {
        return $this->week;
    }

    public function setWeek(Week $week)
    {
        $this->week = $week;

        return $this;
    }

    /**
     * @ORM\Column(type="time")
     */
    protected $start;

    /**
     * Get date
     *
     * @param  string $format format
     * @return string
     */
    public function getStart($format = 'H:m a')
    {
        return date($format, $this->start);
    }

    /**
     * Set start
     *
     * @param  DateTime $start start
     * @return Period
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @ORM\Column(type="time")
     */
    protected $end;

    /**
     * Get date
     *
     * @param  date   $format format
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
     * @return Period
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
     * @return Period
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
