<?php
namespace SCSS\ReportBundle\Interfaces;

interface ReportInterface
{
    public function getName();

    public function getTemplate();

    public function render(array $options);

    public function generate(array $options);
}