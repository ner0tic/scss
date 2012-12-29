<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Organization;
use Scss\OrganizationBundle\Form\Type\OrganizationType;

class OrganizationController extends Controller 
{
    public function indexAction() 
    {
        $max_per_pg = 10;
        $cur_pg = $this->getRequest()->get( 'page', 1 );
        
        $repo = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Organization' );
        $query = $repo->createQueryBuilder( 'o' )->orderBy( 'o.name', ' ASC' );
        
        $pager = new Pagerfanta( new DoctrineORMAdapter( $query ) );
        
        $pager->SetMaxPerPage( $max_per_pg );
        $pager->setCurrentPage( $cur_pg );
        
        return $this->render( 'ScssOrganizationBundle:Organization:index.html.twig', array(
            'entities'        =>  $pager->getCurrentPageResults(),
            'pagerfanta_inst' =>  $pager,
            'num_pages'       =>  $pager->getNbPages()
        ));
    }
  
    public function newAction() 
    {
        $organization = new Organization();
        
        $form = $this->createForm( new OrganizationType(), $organization );
        return $this->render( 'ScssOrganizationBundle:Organization:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
  
    public function showAction($slug) 
    {
        $organization = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Organization')->find( $slug );
        
        if( !$organization )
        {
            throw $this->createNotFoundException( 'No organization found.' ); 
        }       
        
        return $this->render( 'ScssOrganizationBundle:Organization:show.html.twig', array(
            'organization_slug' => $organization->getSlug()
        ));        
    }
    
    public function createAction() 
    {
        $organization = new Organization();
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist( $organization );
        $em->flush();
         
        return forward( 'ScssOrganizationBundle:Organization:show', array(
            'slug'  =>  $organization->getSlug()
        ));
    }
    
    public function dashboardAction()
    {
        return $this->render( 'ScssOrganizationBundle:Organization:dashboard.htmltwig' );
    }
}
