<?php

namespace Scss\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class UserController extends Controller {
    public function indexAction($pager_1=1, $pager_2=1) {
      $user = $this->get('security.context')->getToken()->getUser();
      $max_per_pg = 10;
      $cur_pg[] = $this->getRequest()->get('pager_1', 1);
      $cur_pg[] = $this->getRequest()->get('pager_2', 1);
      if($this->get('security.context')->isGranted('ROLE_USER')) { // user is authorized
        if($this->get('security.context')->isGranted('ROLE_ADMIN')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_REGION_USER')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_ORGANIZATION_USER')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_FACILITY_ADMIN')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_FACILITY_FACULTY')) {
          
        } elseif($this->get('security.context')->isGranted('ROLE_GROUP_ADMIN')) {
          
        }
        
        // attendees
        $user = $this->get('security.context')->getToken()->getUser();
        $max_per_pg = 10;

        $repo         = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Attendee');
        $query        = $repo->createQueryBuilder('a')->orderBy('a.last_name',' ASC');    
        $a_pager      = new Pagerfanta(new DoctrineORMAdapter($query));    
        $a_entities   = $a_pager->getCurrentPageResults();
        $nb_a_pages   = $a_pager->getNbPages();
        $a_pager->SetMaxPerPage($max_per_pg);
        $a_pager->setCurrentPage($this->getRequest()->get('a_page', 1));

        $repo         = $this->getDoctrine()->getRepository('ScssOrganizationBundle:SubGroup');
        $query        = $repo->createQueryBuilder('a')->orderBy('a.name',' ASC');    
        $sg_pager     = new Pagerfanta(new DoctrineORMAdapter($query));    
        $sg_entities  = $sg_pager->getCurrentPageResults();
        $nb_sg_pages  = $sg_pager->getNbPages();
        $sg_pager->SetMaxPerPage($max_per_pg);
        $sg_pager->setCurrentPage($this->getRequest()->get('sg_page', 1));

        return $this->render('ScssUserBundle:User:dashboard.html.twig', array(
            'attendees'  =>  $a_entities,
            'subgroups' =>  $sg_entities,
            'a_pager'     =>  $a_pager,
            'sg_pager'    =>  $sg_pager,
            'nb_a_pages'  =>  $nb_a_pages,
            'nb_sg_pages' =>  $nb_sg_pages));
      }
      else
        return $this->render('ScssUserBundle:User:index.html.twig');
    }
}
