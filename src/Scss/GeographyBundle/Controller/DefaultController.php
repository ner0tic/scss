<?php

namespace Scss\GeographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ScssGeographyBundle:Default:index.html.twig', array('name' => $name));
    }
}
