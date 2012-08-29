<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\Quarters;
use Scss\FacilityBundle\Form\Type\QuartersGroupType;

class QuartersGroupController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:QuartersGroup');
    $query = $repo->createQueryBuilder('g')->where('g.type=:type')->setParameter('type', 'group')->orderBy('g.name',' ASC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:QuartersGroup:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $quarters_group = new QuartersGroup();
    $form = $this->createForm(new QuartersGroupType(), $quarters_group);
    return $this->render('ScssFacilityBundle:QuartersGroup:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $quarters_group = $this->getDoctrine()->getRepository('ScssFacilityBundle:QuartersGroup')->find($slug);
    if(!$quarters_group)  throw $this->createNotFoundException('No quarters_group found.');        
  }
  
  public function createAction() {
    $quarters_group = new QuartersGroup();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($quarters_group);
    $em->flush();
    return forward('ScssFacilityBundle:QuartersGroup:show', array('slug', $quarters_group->getSlug()));
  }
}
