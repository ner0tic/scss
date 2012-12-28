<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Rank;
use Scss\OrganizationBundle\Form\Type\RankType;

class RankController extends Controller 
{
    public function indexAction() 
    {
        $max_per_pg = 10;
        $cur_pg = $this->getRequest()->get( 'page', 1 );

        $repo = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Rank' );
        $query = $repo->createQueryBuilder( 'r' )->orderBy( 'r.name', ' ASC' );

        $pager = new Pagerfanta( new DoctrineORMAdapter( $query ) );

        $pager->SetMaxPerPage( $max_per_pg );
        $pager->setCurrentPage( $cur_pg );

        return $this->render('ScssOrganizationBundle:Rank:index.html.twig', array(
            'entities'        =>  $pager->getCurrentPageResults(),
            'pagerfanta_inst' =>  $pager,
            'num_pages'       =>  $pager->getNbPages()
        ));
    }

    public function newAction() 
    {
        $rank = new Rank();
      
        $form = $this->createForm( new RankType(), $rank );
      
        return $this->render( 'ScssOrganizationBundle:Rank:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showAction( $slug ) 
    {
        $rank = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Rank' )->find( $slug );
      
        if( !$rank )  
        {
            throw $this->createNotFoundException( 'No rank found.' );        
        }
        
        return $this->render( 'ScssOrganizationBundle:Rank:show.html.twig', array(
            'rank' => $rank
        ));         
    }

    public function createAction() 
    {
        $rank = new Rank();
      
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist( $rank );
        $em->flush();
      
        return forward( 'ScssOrganizationBundle:Rank:show', array(
            'slug'  =>  $rank->getSlug()
        ));
    }
}
