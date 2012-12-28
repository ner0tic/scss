<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\ScssGroup;
use Scss\OrganizationBundle\Form\Type\ScssGroupType;

class ScssGroupController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:ScssGroup');
    $query = $repo->createQueryBuilder('g')->orderBy('g.name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:ScssGroup:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $scss_group = new ScssGroup();
    $form = $this->createForm(new ScssGroupType(), $scss_group);
    return $this->render('ScssOrganizationBundle:ScssGroup:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $scss_group = $this->getDoctrine()->getRepository('ScssOrganizationBundle:ScssGroup')->find($slug);
    if(!$scss_group)  throw $this->createNotFoundException('No group found.');        
  }
  
  public function createAction() {
    $scss_group = new ScssGroup();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($scss_group);
    $em->flush();
    return forward('ScssOrganizationBundle:ScssGroup:show', array('slug', $scss_group->getSlug()));
  }
}
