<?php

namespace Scss\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

class UserController extends Controller 
{
    protected $available_roles = array();
    
    public function indexAction( $pager_1 = 1, $pager_2 = 1 ) 
    {
        /**
         * If the user is atleast authenticated
         * with the system then we can continue.
         */
        if( $this->get( 'security.context' )->isGranted( 'ROLE_USER' ) )
        {
            $s = $this->get( 'security.context' );
            if( $s->isGranted( 'ROLE_ADMIN' ) )
            {
                $this->forwardToDashboard( ( $s->isGranted( ' ROLE_SUPER_ADMIN' ) ? 'ROLE_SUPER_ADMIN' : 'ROLE_ADMIN' ) );                
            }
            else if ( $s->isGranted( 'ROLE_REGION_USER' ) )
            {
                $this->forwardToDashboard( ( $s->isGranted( ' ROLE_REGION_ADMIN' ) ? 'ROLE_REGION_ADMIN' : 'ROLE_REGION_USER' ) );                
            }
            else if ( $s->isGranted( 'ROLE_ORG_USER' ) )
            {
                $this->forwardToDashboard( ( $s->isGranted( ' ROLE_ORG_ADMIN' ) ? 'ROLE_ORG_ADMIN' : 'ROLE_ORG_USER' ) );                
            }
            else if ( $s->isGranted( 'ROLE_FACILITY_ADMIN ') )
            {
                $this->forwardToDashboard( ( $s->isGranted( ' ROLE_FACILITY_ADMIN' ) ? 'ROLE_FACILITY_ADMIN' : ( $s->isGranted( 'ROLE_FACILITY_FACULTY' ) ? 'ROLE_FACILITY_FACULTY' : 'ROLE_FACILITY_USER' ) ) );
            }
            else if ( $s->isGranted( 'ROLE_PASSEL_USER' ) )
            {
                $this->forwardToDashboard( ( $s->isGranted( ' ROLE_PASSEL_ADMIN' ) ? 'ROLE_PASSEL_ADMIN' : ( $s->isGranted( 'ROLE_PASSEL_LEADER' ) ? 'ROLE_PASSEL_LEADER' : 'ROLE_PASSEL_USER' ) ) );
            }                       
        }
                
        return $this->render( 'ScssUserBundle:User:index.html.twig' );
    }
    
    public function registerAction()
    {
        $form = $this->createForm(
            new RegistrationType(),
            new Registration()
        );

        return $this->render( 'ScssUserBundle:User:register.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }    
    
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm( new RegistrationType(), new Registration() );

        $form->bind( $this->getRequest() );

        if ( $form->isValid() ) 
        {
            $registration = $form->getData();

            $em->persist( $registration->getUser() );
            $em->flush();

            return $this->redirect( 'ScssUserBundle:User:dashboard' );
        }

        return $this->render( 'ScssUserBundle:User:register.html.twig', array(
            'form'  =>  $form->createView()
        ));
    }    
       
    private function forwardToDashboard( $role )
    {
        /**
         * @todo find a cleaner way to match the role to the controller
         */
        $roleEntities = array(
            'ROLE_PASSEL_USER'          =>  'ScssOrganizationBundle:Attendee:dashboard',
            'ROLE_PASSEL_LEADER'        =>  'ScssOrganizationBundle:PasselLeader:dasboard',
            'ROLE_PASSEL_ADMIN'         =>  'ScssOrganizationBundle:PasselLeader:dasboard',
            'ROLE_FACILITY_USER'        =>  'ScssFacilityBundle:Faculty:dasboard',
            'ROLE_FACILITY_FACULTY'     =>  'ScssFacilityBundle:Faculty:dasboard',
            'ROLE_FACILITY_ADMIN'       =>  'ScssFacilityBundle:Faculty:dasboard',
            'ROLE_ORG_USER'             =>  'ScssOrganizationBundle:Organization:dasboard',
            'ROLE_ORG_ADMIN'            =>  'ScssOrganizationBundle:Organization:dasboard',
            'ROLE_REGION_USER'          =>  'ScssGeographyBundle:Region:dasboard',
            'ROLE_REGION_ADMIN'         =>  'ScssGeographyBundle:Region:dasboard',
            'ROLE_ADMIN'                =>  'ScssUserBundle:Admin:dasboard',
            'ROLE_SUPER_ADMIN'          =>  'ScssUserBundle:Admin:dasboard'
        );
        $this->forward( $roleEntities[ $role ] );        
    }
}
