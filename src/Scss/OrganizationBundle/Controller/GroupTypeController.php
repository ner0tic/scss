<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\GroupType;
use Scss\OrganizationBundle\Form\Type\GroupTypeType;

class GroupTypeController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:GroupType');
    $query = $repo->createQueryBuilder('t')->orderBy('t.name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:GroupType:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $group_type = new GroupType();
    $form = $this->createForm(new GroupTypeType(), $group_type);
    return $this->render('ScssOrganizationBundle:GroupType:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $group_type = $this->getDoctrine()->getRepository('ScssOrganizationBundle:GroupType')->find($slug);
    if(!$group_type)  throw $this->createNotFoundException('No group type found.');        
  }
  
  public function createAction() {
    $group_type = new GroupType();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($group_type);
    $em->flush();
    return forward('ScssOrganizationBundle:GroupType:show', array('slug', $group_type->getSlug()));
  }
}
