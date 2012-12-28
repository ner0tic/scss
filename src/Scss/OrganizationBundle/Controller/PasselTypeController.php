<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\PasselType;
use Scss\OrganizationBundle\Form\Type\PasselTypeType;

class PasselTypeController extends Controller 
{
    public function indexAction() 
    {
        $max_per_pg = 10;
        $cur_pg = $this->getRequest()->get( 'page', 1 );

        $repo = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:PasselType' );
        $query = $repo->createQueryBuilder( 't' )->orderBy( 't.name', ' ASC' );

        $pager = new Pagerfanta( new DoctrineORMAdapter( $query ) );

        $pager->SetMaxPerPage( $max_per_pg );
        $pager->setCurrentPage( $cur_pg );

        return $this->render('ScssOrganizationBundle:PasselType:index.html.twig', array(
            'entities'        =>  $pager->getCurrentPageResults(),
            'pagerfanta_inst' =>  $pager,
            'num_pages'       =>  $pager->getNbPages()
        ));
    }

    public function newAction() 
    {
        $passel_type = new PasselType();
      
        $form = $this->createForm( new PasselTypeType(), $passel_type );
      
        return $this->render( 'ScssOrganizationBundle:PasselType:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showAction( $slug ) 
    {
        $passel_type = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:PasselType' )->find( $slug );
      
        if( !$passel_type )  
        {
            throw $this->createNotFoundException( 'No passel type found.' );        
        }
        
        return $this->render( 'ScssOrganizationBundle:PasselType:show.html.twig', array(
            'passel_type' => $passel_type
        ));              
    }

    public function createAction() 
    {
        $passel_type = new PasselType();
      
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist( $passel_type );
        $em->flush();
      
        return forward( 'ScssOrganizationBundle:PasselType:show', array(
            'slug'  =>  $passel_type->getSlug()
        ));
    }
}
