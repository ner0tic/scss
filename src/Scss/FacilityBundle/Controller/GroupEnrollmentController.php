<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\GroupEnrollment;
use Scss\FacilityBundle\Form\Type\GroupEnrollmentType;

class GroupEnrollmentController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:GroupEnrollment');
    $query = $repo->createQueryBuilder('e')->where('e.group_id = :id')->setParameter('id', $user->getActiveEnrollment()->getGroup()->getId())->orderBy('e.created','DESC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:GroupEnrollment:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $group_enrollment = new GroupEnrollment();
    $form = $this->createForm(new GroupEnrollmentType(), $group_enrollment);
    return $this->render('ScssFacilityBundle:GroupEnrollment:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $group_enrollment = $this->getDoctrine()->getRepository('ScssFacilityBundle:GroupEnrollment')->find($slug);
    if(!$group_enrollment)  throw $this->createNotFoundException('No group_enrollment found.');        
  }
  
  public function createAction() {
    $group_enrollment = new GroupEnrollment();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($group_enrollment);
    $em->flush();
    return forward('ScssFacilityBundle:GroupEnrollment:show', array('slug', $group_enrollment->getSlug()));
  }
}
