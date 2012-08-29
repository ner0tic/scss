<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\Facility;
use Scss\FacilityBundle\Form\Type\FacilityType;

class FacilityController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:Facility');
    $query = $repo->createQueryBuilder('f')->orderBy('f.name',' ASC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:Facility:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $facility = new Facility();
    $form = $this->createForm(new FacilityType(), $facility);
    return $this->render('ScssFacilityBundle:Facility:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $facility = $this->getDoctrine()->getRepository('ScssFacilityBundle:Facility')->find($slug);
    if(!$facility)  throw $this->createNotFoundException('No facility found.');        
  }
  
  public function createAction() {
    $facility = new Facility();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($facility);
    $em->flush();
    return forward('ScssFacilityBundle:Facility:show', array('slug', $facility->getSlug()));
  }
}
