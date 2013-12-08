<?php
namespace SCSS\ReportsBundle\Entity;

use SCSS\ReportsBundle\Interface\ReportInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\BlameableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

class AttendeeAlphabeticalReport implements ReportInterface
{
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Get name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  $name name
     * @return  string
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\Column(type="string")
     */
    protected $template;

    /**
     * Get template
     *
     * @return  string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set template
     *
     * @param  $template template
     * @return  string
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Generate
     *
     * @param  $options array
     */
    public function generate(array $options)
    {

    }

    /**
     * Render
     */
    public function render(array $options)
    {

    }
}