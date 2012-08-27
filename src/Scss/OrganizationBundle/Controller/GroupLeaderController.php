<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\GroupLeader;
use Scss\OrganizationBundle\Form\Type\GroupLeaderType;

class GroupLeaderController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:GroupLeader');
    $query = $repo->createQueryBuilder('g')->orderBy('g.last_name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:GroupLeader:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $group_leader = new GroupLeader();
    $form = $this->createForm(new GroupLeaderType(), $group_leader);
    return $this->render('ScssOrganizationBundle:GroupLeader:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $group_leader = $this->getDoctrine()->getRepository('ScssOrganizationBundle:GroupLeader')->find($slug);
    if(!$group_leader)  throw $this->createNotFoundException('No grop leader found.');        
  }
  
  public function createAction() {
    $group_leader = new GroupLeader();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($group_leader);
    $em->flush();
    return forward('ScssOrganizationBundle:GroupLeader:show', array('slug', $group_leader->getSlug()));
  }
}
