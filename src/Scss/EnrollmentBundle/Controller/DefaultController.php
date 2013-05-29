<?php

namespace Scss\EnrollmentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ScssEnrollmentBundle:Default:index.html.twig', array('name' => $name));
    }
}
