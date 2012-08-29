<?php

namespace Scss\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\FacilityBundle\Entity\Faculty;
use Scss\FacilityBundle\Entity\Facility;
use Scss\FacilityBundle\Form\Type\FacultyType;

class FacultyController extends Controller {
  public function indexAction() {
    $user = $this->get('security.context')->getToken()->getUser();
    $max_per_pg = 10;
    $cur_pg = $this->getRequest()->get('page', 1);    
    
    $repo = $this->getDoctrine()->getRepository('ScssFacilityBundle:Faculty');
    $query = $repo->createQueryBuilder('f')
                    ->join('f.facility y')
                    ->where('y.slug = :slug')
                    ->setParameter('slug', $this->getRequest()->get('facility_slug'))
                    ->orderBy('f.last_name',' ASC');
    
    $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($query));
    
    $pagerfanta->SetMaxPerPage($max_per_pg);
    $pagerfanta->setCurrentPage($cur_pg);
    
    $entities = $pagerfanta->getCurrentPageResults();
    $pages = $pagerfanta->getNbPages();
    
    return $this->render('ScssFacilityBundle:Faculty:index.html.twig', array(
        'entities'        => $entities,
        'pagerfanta_inst' =>  $pagerfanta,
        'num_pages'       =>  $pages));
  }
  
  public function newAction() {
    $faculty = new Faculty();
    $form = $this->createForm(new FacultyType(), $faculty);
    return $this->render('ScssFacilityBundle:Faculty:new.html.twig', array(
        'form' => $form->createView()));
  }
  
  public function showAction($slug) {
    $faculty = $this->getDoctrine()->getRepository('ScssFacilityBundle:Faculty')->find($slug);
    if(!$faculty)  throw $this->createNotFoundException('No faculty found.');        
  }
  
  public function createAction() {
    $faculty = new Faculty();
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($faculty);
    $em->flush();
    return forward('ScssFacilityBundle:Faculty:show', array('slug', $faculty->getSlug()));
  }
}
