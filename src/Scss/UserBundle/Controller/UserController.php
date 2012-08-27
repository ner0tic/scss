<?php

namespace Scss\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {
    public function indexAction() {
      if($this->get('security.context')->isGranted('ROLE_USER')) { // user is authorized
        if($this->get('security.context')->isGranted('ROLE_ADMIN')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_REGION_USER')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_ORGANIZATION_USER')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_FACILITY_ADMIN')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_FACILITY_FACULTY')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_GROUP_ADMIN')) {
          
        }
      
        return $this->render('ScssUserBundle:User:dashboard.html.twig');
      }
      else
        return $this->render('ScssUserBundle:User:index.html.twig');
    }
}
