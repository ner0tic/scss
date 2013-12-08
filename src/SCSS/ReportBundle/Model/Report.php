<?php
namespace SCSS\ReportsBundle\Model;

use SCSS\ReportsBundle\Interface\ReportInterface;

class Report implements ReportInterface
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    protected $template;

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function generate(array $options)
    {

    }

    public function render(array $options)
    {

    }
}