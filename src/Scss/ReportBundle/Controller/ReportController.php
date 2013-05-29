<?php

namespace Scss\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ScssReportBundle:Report:index.html.twig', array('name' => $name));
    }
}
