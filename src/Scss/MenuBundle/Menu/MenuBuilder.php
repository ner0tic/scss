<?php
namespace Scss\MenuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware 
{
    protected $activeEnrollLabel;
    
    public function __construct( FactoryInterface $factory ) 
    {
        $this->factory = $factory; 
        $this->user = $this->container->get('security.context')->getToken()->getUser();
    }
    
    public function createSuperAdminMenu( Request $request ) {
        $menu = $this->createAdminMenu( $request );
        $menu->addChild( 'site mgmt',                       array(
            'uri'               =>  'site-mgmt'
        ) );
    }
    
    public function createAdminMenu( Request $request ) {
        
        
    }
    
    public function createOrganizationMenu( Request $request ) {}
    
    public function createFacilityMenu( Request $request ) 
    {
        $menu = $this->createBaseMenu( $request );        
        
        ////////////////////////////////////////////////////////////////////////
        // Faculty Menu 
        ////////////////////////////////////////////////////////////////////////
        $this->activeEnrollLabel = $user->getActiveEnrollment()->getFacility() . ' ' . $user->getActiveEnrollment()->getWeek();
        
        ////////////////////////////////////////////////////////////////////
        // Active Enrollment Menu Item
        ////////////////////////////////////////////////////////////////////       
        $menu->addChild(
                $this->activeEnrollLabel,
                array(
                    'uri'                   =>  'weeks_by_facility',
                    'routeParameters'       =>  array(
                        'region_slug'       =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getRegion()
                                                     ->getSlug(),
                        'facility_slug'     =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
        ) ) );

        foreach( $user->getActiveEnrollment()->getFacility()->getWeeks() as $week )
        {
            if ($week->getId() != $user->getActiveEnrollment()->getWeek()->getId() )
            {
                $menu[ $this->activeEnrollLabel ]->addChild(
                        $user->getActiveEnrollment()->getFacility() . ' ' . $week,
                        array(
                            'uri'               =>  'change-active-week',
                            'routeParamters'    =>  array(
                                'region_slug'       =>  $user->getActiveEnrollment()
                                                             ->getFacility()
                                                             ->getRegion()
                                                             ->getSlug(),
                                'facility_slug'     =>  $user->getActiveEnrollment()
                                                             ->getFacility()
                                                             ->getSlug(),
                                'week_slug'         =>  $week->getSlug()
                ) ) );
            }
        }

        ////////////////////////////////////////////////////////////////////
        // Class Mgmt Menu Item
        ////////////////////////////////////////////////////////////////////
        $menu->addChild(
                'class management',
                array(
                    'uri'                   =>  'class_mgmt',
                    'routeParameters'       =>  array(

        ) ) );

        ////////////////////////////////////////////////////////////////////
        // Reports
        ////////////////////////////////////////////////////////////////////
        $menu->addChild(
                'reports',
                array(
                    'uri'                   =>  'reports',
        ) );        
        
        
        ////////////////////////////////////////////////////////////////////////
        // Faculty Admin Menu Additions
        ////////////////////////////////////////////////////////////////////////
        if( $user->isGranted( 'ROLE_FACULTY_ADMIN' ) )
        {
            $menu[ $this->activeEnrollLabel ]->addChild(
            'passel enrollments',
            array(
                'uri'                   =>  'passel_enrollments',
                'routeParameters'       =>  array(
                    'region_slug'       =>  $user->getActiveEnrollment()
                                                 ->getFacility()
                                                 ->getRegion()
                                                 ->getSlug(),
                    'facility_slug'     =>  $user->getActiveEnrollment()
                                                 ->getFacility()
                                                 ->getSlug(),
                    'week_slug'         =>  $user->getActiveEnrollment()
                                                 ->getWeek()
                                                 ->getSlug(),
            ) ) );
            ////////////////////////////////////////////////////////////////////
            // Facility Mgmt Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'facility management',
                    array(
                        'uri'                   =>  'facility_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage weeks',
                    array(
                        'uri'                   =>  'week_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()                        
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage departments',
                    array(
                        'uri'                   =>  'dept_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()                        
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage quarters',
                    array(
                        'uri'                   =>  'quarters_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage faculty',
                    array(
                        'uri'                   =>  'faculty_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()                        
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage periods',
                    array(
                        'uri'                   =>  'period_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()                        
            ) ) );

            $menu[ 'facility management' ]->addChild(
                    'manage classes',
                    array(
                        'uri'                   =>  'class_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug()
            ) ) );
        }
	
	return $menu;        
    }
    
    /*
     * Passel Related Role Menu
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem $menu
     */
    public function createPasselMenu( Request $request ) 
    {
        $menu = $this->createBaseMenu( $request );
        
        $this->activeEnrollLabel = $user->getActiveEnrollment()->getFacility() . ' - ' . $user->getActiveEnrollment()->getWeek();            
                
        ////////////////////////////////////////////////////////////////////////
        // Passel Leader Menu
        ////////////////////////////////////////////////////////////////////////
        if( $user->isGranted( 'ROLE_PASSEL_LEADER' ) )
        {
            ////////////////////////////////////////////////////////////////////
            // Active Enrollment Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    $this->activeEnrollLabel,    
                    array(
                        'uri'               =>  'passel_enrollment_show',
                        'routeParameters'   =>  array(
                            'id'            =>  $user->getActiveEnrollment()
                                                     ->getPasselEnrollmentId()
            ) ) );
            
            foreach( $user->getActiveEnrollment()->getPassel()->getEnrollments() as $enrollment )
            {
                $menu[ $this->activeEnrollLabel ]->addChild( 
                        $enrollment()->getFacility() . ' - ' . $enrollment()->getWeek(), 
                        array(
                            'uri'               =>  'change-enrollment',
                            'routeParameters'   =>  array(
                                'facility_slug' =>  $enrollment()->getFacility()->getSlug(),
                                'week_slug'     =>  $enrollment()->getWeek()->getSlug(),                    
                ) ) );
            }
            
            ////////////////////////////////////////////////////////////////////
            // Passel Mgmt Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    'passel management',                 
                    array(
                        'uri'               =>  'attendee_mgmt',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollmenr()
                                                     ->getPassel()
                                                     ->getSlug(),
            ) ) );
            
            $menu[ 'passel management' ]->addChild( 
                    'enrollment',     
                    array(                    
                        'uri'               =>  'attendee_enrollment',
                        'routeParameter'    =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getSlug(),
            ) ) );
            
            $menu[ 'passel management' ]->addChild( 
                    'manage factions',    
                    array(
                        'uri'               =>  'faction_mgmt',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getSlug(),
            ) ) );
            
            ////////////////////////////////////////////////////////////////////
            // Reports Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    'reports',
                    array(
                        'uri'               =>  'reports',
            ) );
            
            $menu[ 'reports' ]->addChild( 
                    'alphabetical list',
                    array(
                        'uri'               =>  'reports_alpha',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),                    
            ) ) );
            
            $menu[ 'reports' ]->addChild( 
                    'medlist',              
                    array(
                        'uri'               =>  'report_medlist',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),                    
            ) ) );
            
            $menu[ 'reports' ]->addChild( 
                    'master schedule',      
                    array(
                        'uri'               =>  'report_master_sched',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),                    
            ) ) );
            
            $menu[ 'reports' ]->addChild( 
                    'incomplete attendee schedules',              
                    array(
                        'uri'               =>  'report_inc_attendees',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),                    
            ) ) );
            
            ////////////////////////////////////////////////////////////////////
            // Passel Admin Menu Additions
            ////////////////////////////////////////////////////////////////////
            if( $user->isGranted( 'ROLE_PASSEL_ADMIN' ) )
            {
                $menu[ 'profile' ]->addChild(
                        'promote leader',
                        array(
                            'uri'               =>  'promote_leader',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
                ) ) );

                $menu[ $this->activeEnrollLabel ]->addChild( 
                        'enroll in a facility', 
                        array(
                            'uri'               =>  'passel_enrollment_new',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),                    
                ) ) );
                
                $menu->addChild(
                        'passel leader management',
                        array(
                            'uri'               =>  'passel_leader_mgmt',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),                                      
                ) ) );
            }
            
        }
        ////////////////////////////////////////////////////////////////////////
        // Attendee Menu
        ////////////////////////////////////////////////////////////////////////
        else if( $user->isGranted( 'ROLE_PASSEL_USER' ) )
        {
            ////////////////////////////////////////////////////////////////////
            // Active Enrollment Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    $this->activeEnrollLabel,    
                    array(
                        'uri'               =>  'passel_enrollment_show',
                        'routeParameters'   =>  array(
                            'id'            =>  $user->getActiveEnrollment()
                                                     ->getPasselEnrollmentId()
            ) ) );
            
            $menu[ $this->activeEnrollLabel ]->addChild( 
                    'enroll', 
                    array(
                        'uri'               =>  'attendee_enrollment_new',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),                    
            ) ) );
            
            $menu[ $this->activeEnrollLabel ]->addChild( 
                    'mealplan',
                    array(
                        'uri'               =>  'mealplan',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                      ->getWeek()
                                                      ->getSlug(),                    
            )));
            
            $menu[ $this->activeEnrollLabel ]->addChild( 
                    'packinglist',                   
                    array(
                        'uri'               =>  'packing-list',
                        'routeParameters'   =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
            ) ) );
            
            $menu[ $this->activeEnrollLabel ]->addChild( 
                    'change facilities',
                    array( 
                        'uri'                   =>  'passel_enrollments_by_passel', 
                        'routeParamters'        =>  array(
                            'passel_slug'       =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug()
            ) ) );
            
            ////////////////////////////////////////////////////////////////////
            // Med List Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    'med list',    
                    array(
                        'uri'                   =>  'medlist',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
            ) ) );
            
            $menu[ 'medlist' ]->addChild( 
                    'add item',
                    array(
                        'uri'                   =>  'medlist_new',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),                    
            ) ) );
            
            ////////////////////////////////////////////////////////////////////
            // Reports
            ////////////////////////////////////////////////////////////////////
            $menu->addChild( 
                    'reports',    
                    array(
                        'uri'                   =>  'reports',
            ) );
            
            $menu[ 'reports' ]->addChild( 
                    'schedule',
                    array(
                        'uri'                   =>  'report_attendee_schedule',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(), 
            ) ) );
            
            $menu[ 'reports' ]->addChild( 
                    'medlist',              
                    array(
                        'uri'                   =>  'report_medlist',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
            ) ) );
        }
            
        return $menu;
    }
  
    /**
     * Navigation root menu for auth'd user (attendee, passel_leader, 
     * passel_admin, facility_user, faculty, facility_admin, region_user, 
     * region_admin, organization_user, organization_admin)
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem $menu
     */
    public function createMainMenu( Request $request ) 
    {     
        $menu = $this->factory->createItem( 'root' );
      
        $menu->addChild( 
                'home',
                array( 
                    'uri'             =>    'homepage' 
        ) );
        
        $menu->addChild(
                'profile',
                array(
                    'uri'             =>    'user_show',
                    'routeParameters' =>    array(
                        'user_slug'   =>    $user->getSlug()
        ) ) );  
        
        $menu[ 'profile' ]->addChild(
                'edit',
                array(
                    'uri'             =>    'user_profile_edit',
                
        ) );        

        return $menu;
    }

    /**
     * Navigation menu for a non auth'd user (guest)
     * 
     * @param Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem $menu 
     */
    public function createNonauthMenu(Request $request) 
    {
        $menu = $this->factory->createItem('nonauth');
        $menu->addChild(
                'home',     
                array(
                    'uri'           =>  'homepage'
        ) );
        
        $menu->addChild(
                'sign in',  
                array(
                    'uri'           =>  'fos_user_security_login'
        ) );
        
        $menu->addChild(
                'sign up',
                array(
                    'uri'           =>  'fos_user_registration_register'
        ) );
        
        $menu->addChild(
                'about',    
                array(
                    'uri'           =>  'about'
        ) );
        
        $menu->addChild(
                'contact',  
                array(
                    'uri'           =>  'contact'
        ) );
        
        return $menu;
    }
}
