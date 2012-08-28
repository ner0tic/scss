<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\SubGroup;
use Scss\OrganizationBundle\Form\Type\SubGroupType;

class SubGroupController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:SubGroup');
    $query = $repo->createQueryBuilder('g')->orderBy('g.name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:SubGroup:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $sub_group = new SubGroup();
    $form = $this->createForm(new SubGroupType(), $sub_group);
    return $this->render('ScssOrganizationBundle:SubGroup:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $sub_group = $this->getDoctrine()->getRepository('ScssOrganizationBundle:SubGroup')->find($slug);
    if(!$sub_group)  throw $this->createNotFoundException('No sub group found.');        
    return $this->render('ScssOrganizationBundle:SubGroup:show.html.twig', array(
        'sub_group' => $sub_group));
  }
  
  public function createAction() {
    $sub_group = new SubGroup();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($sub_group);
    $em->flush();
    return forward('ScssOrganizationBundle:SubGroup:show', array('slug', $sub_group->getSlug()));
  }
}
