<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Rank;
use Scss\OrganizationBundle\Form\Type\RankType;

class RankController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Rank');
    $query = $repo->createQueryBuilder('r')->orderBy('r.name',' ASC');
    
    $adapter = new DoctrineORMAdapter($query);
    $pagerfanta = new Pagerfanta($adapter);
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssOrganizationBundle:Rank:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanata,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $rank = new Rank();
    $form = $this->createForm(new RankType(), $rank);
    return $this->render('ScssOrganizationBundle:Rank:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $rank = $this->getDoctrine()->getRepository('ScssOrganizationBundle:Rank')->find($slug);
    if(!$rank)  throw $this->createNotFoundException('No rank found.');        
  }
  
  public function createAction() {
    $rank = new Rank();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($rank);
    $em->flush();
    return forward('ScssOrganizationBundle:Rank:show', array('slug', $rank->getSlug()));
  }
}
