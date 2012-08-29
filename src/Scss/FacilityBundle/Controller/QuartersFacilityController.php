<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\Quarters;
use Scss\FacilityBundle\Form\Type\QuartersFacilityType;

class QuartersFacilityController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:QuartersFacility');
    $query = $repo->createQueryBuilder('f')->orderBy('f.name',' ASC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:QuartersFacility:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $quarters_facility = new QuartersFacility();
    $form = $this->createForm(new QuartersFacilityType(), $quarters_facility);
    return $this->render('ScssFacilityBundle:QuartersFacility:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $quarters_facility = $this->getDoctrine()->getRepository('ScssFacilityBundle:QuartersFacility')->find($slug);
    if(!$quarters_facility)  throw $this->createNotFoundException('No quarters_facility found.');        
  }
  
  public function createAction() {
    $quarters_facility = new QuartersFacility();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($quarters_facility);
    $em->flush();
    return forward('ScssFacilityBundle:QuartersFacility:show', array('slug', $quarters_facility->getSlug()));
  }
}
