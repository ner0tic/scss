<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\PasselLeader;
use Scss\OrganizationBundle\Form\Type\PasselLeaderType;

class PasselLeaderController extends Controller 
{
    public function indexAction() 
    {
        $max_per_pg = 10;
        $cur_pg = $this->getRequest()->get( 'page', 1 );

        $repo = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:PasselLeader' );
        $query = $repo->createQueryBuilder( 'p' )->orderBy( 'p.last_name', ' ASC' );

        $pager = new Pagerfanta( new DoctrineORMAdapter( $query ) );

        $pager->SetMaxPerPage( $max_per_pg );
        $pager->setCurrentPage( $cur_pg );

        return $this->render('ScssOrganizationBundle:PasselLeader:index.html.twig', array(
            'entities'        =>  $pager->getCurrentPageResults(),
            'pagerfanta_inst' =>  $pager,
            'num_pages'       =>  $pager->getNbPages()
        ));
    }
  
    public function newAction() 
    {
        $passel_leader = new PasselLeader();

        $form = $this->createForm( new PasselLeaderType(), $passel_leader );

        return $this->render( 'ScssOrganizationBundle:PasselLeader:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showAction($slug) {
        $passel_leader = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:PasselLeader' )->find( $slug );

        if( !$passel_leader )
        {
          throw $this->createNotFoundException( 'No passel leader found.' );        
        }

        return $this->render( 'ScssOrganizationBundle:PasselLeader:show.html.twig', array(
            'passel_leader' => $passel_leader
        ));      
    }

    public function createAction() 
    {
        $passel_leader = new PasselLeader();
      
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist( $passel_leader );
        $em->flush();
      
        return forward( 'ScssOrganizationBundle:PasselLeader:show', array(
            'slug'  =>  $passel_leader->getSlug()
        ));
    }
}
