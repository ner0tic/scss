<?php

namespace Scss\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Scss\OrganizationBundle\Entity\Faction;
use Scss\OrganizationBundle\Form\Type\FactionType;

class FactionController extends Controller 
{
    public function indexAction() 
    {
        $max_per_pg = 10;
        $cur_pg = $this->getRequest()->get( 'page', 1 );

        $repo = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Faction' );
        $query = $repo->createQueryBuilder( 'f' )->orderBy( 'f.name', ' ASC' );

        $pager = new Pagerfanta( new DoctrineORMAdapter( $query ) );

        $pager->SetMaxPerPage( $max_per_pg );
        $pager->setCurrentPage( $cur_pg );

        return $this->render('ScssOrganizationBundle:Faction:index.html.twig', array(
            'entities'        =>  $pager->getCurrentPageResults(),
            'pagerfanta_inst' =>  $pager,
            'num_pages'       =>  $pager->getNbPages()
        ));
    }

    public function newAction() 
    {
        $faction = new Faction();
      
        $form = $this->createForm( new FactionType(), $faction );
      
        return $this->render('ScssOrganizationBundle:Faction:new.html.twig', array(
          'form' => $form->createView()
        ));
    }

    public function showAction( $slug ) 
    {
        $faction = $this->getDoctrine()->getRepository( 'ScssOrganizationBundle:Faction' )->find( $slug );
        
        if( !$faction )
        {
            throw $this->createNotFoundException( 'No faction found.' );        
        }
      
        return $this->render( 'ScssOrganizationBundle:Faction:show.html.twig', array(
            'faction' => $faction
        ));
    }

    public function createAction() 
    {
        $faction = new Faction();
      
        $em = $this->getDoctrine()->getEntityManager();
      
        $em->persist( $faction );
      
        $em->flush();
      
        return forward( 'ScssOrganizationBundle:Faction:show', array(
            'slug' => $faction->getSlug()
        ));
    }
}
