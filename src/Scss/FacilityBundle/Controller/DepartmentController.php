<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\Department;
use Scss\FacilityBundle\Form\Type\DepartmentType;

class DepartmentController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:Department');
    $query = $repo->createQueryBuilder('d')->orderBy('d.name',' ASC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:Department:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $department = new Department();
    $form = $this->createForm(new DepartmentType(), $department);
    return $this->render('ScssFacilityBundle:Department:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $department = $this->getDoctrine()->getRepository('ScssFacilityBundle:Department')->find($slug);
    if(!$department)  throw $this->createNotFoundException('No department found.');        
  }
  
  public function createAction() {
    $department = new Department();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($department);
    $em->flush();
    return forward('ScssFacilityBundle:Department:show', array('slug', $department->getSlug()));
  }
}
