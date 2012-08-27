<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Organization;
use Scss\OrganizationBundle\Form\Type\OrganizationType;

class OrganizationController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Organization');
    $query = $repo->createQueryBuilder('o')->orderBy('o.name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:Organization:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $organization = new Organization();
    $form = $this->createForm(new OrganizationType(), $organization);
    return $this->render('ScssOrganizationBundle:Organization:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $organization = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Organization')->find($slug);
    if(!$organization)  throw $this->createNotFoundException('No organization found.');        
  }
  
  public function createAction() {
    $organization = new Organization();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($organization);
    $em->flush();
    return forward('ScssOrganizationBundle:Organization:show', array('slug', $organization->getSlug()));
  }
}
