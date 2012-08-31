<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Attendee;
use Scss\OrganizationBundle\Form\Type\AttendeeType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class AttendeeController extends Controller {
  public function indexAction($page=1) {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Attendee');
    $query = $repo->createQueryBuilder('a')->orderBy('a.last_name',' ASC');
    
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:Attendee:index.html.twig', array(
        'attendees'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function groupAction($page=1) {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Attendee');
    $query = $repo->createQueryBuilder('a')->where('a.scss_group = :group_id')->setParameter('group_id', $user->getActiveEnrollment()->getGroup())->orderBy('a.last_name',' ASC')->getQuery();
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:Attendee:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }  
  
  public function newAction(Request $request) {
    $attendee = new Attendee();
    $form = $this->createForm(new AttendeeType(), $attendee);
    if($request->getMethod() == 'POST') {
      $form->bind($request);
      if($form->isValid()) {
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($attendee);
        $em->flush();
        return $this->render('ScssOrganizationBundle:Attendee:show.html.twig', array(
        'attendee_slug' => $attendee->getSlug()));
      }
    }
    return $this->render('ScssOrganizationBundle:Attendee:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $attendee = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Attendee')->find($slug);
    if(!$attendee)  throw $this->createNotFoundException('No attendee found.');        
  }
  
  public function createAction() {
    $attendee = new Attendee();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($attendee);
    $em->flush();
    return forward('ScssOrganizationBundle:Attendee:show', array('slug', $attendee->getSlug()));
  }
}
