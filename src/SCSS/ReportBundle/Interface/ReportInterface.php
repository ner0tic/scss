<?php
namespace SCSS\ReportsBundle\Interface;

interface ReportInterface
{
    public function getName();

    public function getTemplate();

    public function render(array $options);

    public function generate(array $options);
}