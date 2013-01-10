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
            $user_roles = $this->getUser()->getRoles();
            
            /**
             * The array is reversed to reverse sort the roles
             * since they are entered into the security.yml
             * file in a low - high hierarchy.
             */
            var_dump($this->get('security.role')->getToken());die('...');
            $available_roles = array_reverse( $this->get( 'security.role.hierarchy.roles' ) );
        
            foreach( $user_roles as $role )
            {
                if( in_array( $role, $available_roles ) )
                {
                    $this->forwardToDashboard( $role, $available_roles );
                    break;
                }
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
       
    private function forwardToDashboard( $role, $available_roles = array() )
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
            'ROLE_ORGANIZATION_USER'    =>  'ScssOrganizationBundle:Organization:dasboard',
            'ROLE_ORGANIZATION_ADMIN'   =>  'ScssOrganizationBundle:Organization:dasboard',
            'ROLE_REGION_USER'          =>  'ScssGeographyBundle:Region:dasboard',
            'ROLE_REGION_ADMIN'         =>  'ScssGeographyBundle:Region:dasboard',
            'ROLE_ADMIN'                =>  'ScssUserBundle:Admin:dasboard',
            'ROLE_SUPER_ADMIN'          =>  'ScssUserBundle:Admin:dasboard'
        );
        $this->forward( $roleEntities[ $role ] );        
    }
}
