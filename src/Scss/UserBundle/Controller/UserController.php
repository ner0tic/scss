<?php

namespace Scss\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {
    public function indexAction() {
      if($this->get('security.context')->isGranted('ROLE_USER'))
        return $this->render('ScssUserBundle:User:dashbaord.html.twig');
      else
        return $this->render('ScssUserBundle:User:index.html.twig');
    }
}