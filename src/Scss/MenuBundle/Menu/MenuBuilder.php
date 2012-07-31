<?php
// src/Scss/MenuBundle/Menu/MenuBuilder.php
namespace Scss\MenuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {
//  public function __construct(FactoryInterface $factory) {
//    $this->factory = $factory; 
//    $this->user = $this->container->get('security.context')->getToken()->getUser();
//    
//  }
  
    public function createMainMenu(Request $request) {     
      $menu = $this->factory->createItem('root');
      //$menu->setCurrentUri($this->container->get('request')->getRequestUri());
      $menu->addChild('home',               array('uri'             =>  'homepage'));
      $menu->addChild('scout management',   array('uri'             =>  'attendee_by_group', 
                                                  'routeParameters' =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(), 
                                                                             'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu->addChild('patrol management',  array('route'           =>  'subgroup_by_group',
                                                  'routeParameters' =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                                                                              'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
//      $menu->addChild('group settings',     array('route'           =>  'group_mgmt',
//                                                  'routeParameters' =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
//                                                                              'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu->addChild('group management',   array('route'           =>  'group_mgmt',
                                                  'routeParameters' =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                                                                              'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu->addChild('facility settings',                              @facility_mgmt);
  $menu->addChild('facility management',                            @facility_mgmt)
        ->setCredentials(array('regionAdmin','siteAdmin'));
  $menu->addChild('region settings',                          @region_mgmt)
        ->setCredentials(array('regionAdmin'));
  $menu->addChild('region management',                        @region_mgmt)->setCredentials(array('siteAdmin'));
  $menu->addChild('misc settings',                              @misc_settings)->setCredentials(array('siteAdmin'));
  $menu->addChild('class management',                           @class_mgmt)->setCredentials(array('facilityStaff'))->setParameters(array('region_slug'=>$user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),'facility_slug'=>$user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),'week_slug'=>$user->getActiveEnrollment()->getWeek()->getSlug()));
  $menu->addChild('staff information',                          @staff_info)->setCredentials(array('facilityStaff'))->setParameters(array('region_slug'=>$user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),'facility_slug'=>$user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),'week_slug'=>$user->getActiveEnrollment()->getWeek()->getSlug()));
  $menu->addChild('reports',                                    @reports)->setCredentials(array('groupAdmin','facilityAdmin','regionAdmin','siteAdmin'));
  // scout menu
  $menu['scout management']->addChild('add a scout',            @attendee_new          )->setParameters(array('region_slug'=>$user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),'group_slug'=>$user->getActiveEnrollment()->getTroop()->getSlug()));
  $menu['scout management']->addChild('enroll scouts',          @attendee_enroll       )->setParameters(array('region_slug'=>$user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),'facility_slug'=>$user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),'week_slug'=>$user->getActiveEnrollment()->getWeek()->getSlug()));
  // patrol menu
  $menu['patrol management']->addChild('add a patrol',          @patrol_new         )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'group_slug'        =>            $user->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('groupAdmin'));
  // group settings menu
  $menu['group settings']->addChild('manage group photos',      @group_photo        );
  $menu['group settings']->addChild('next season',              @group_register     )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('groupAdmin'));
  $menu['group settings']->addChild('scoutmaster information',  @sm_info            )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'group_slug'        =>            $user->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('groupAdmin'));
  // group management menu
  $menu['group management']->addChild('manage scouts',          @attendee_by_group   )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'group_slug'        =>            $user->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('facilityAdmin','regionAdmin','siteAdmin'));
  $menu['group management']->addChild('manage patrols',         @subgroup_by_group   )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'group_slug'        =>            $user->getActiveEnrollment()->getTroop()->getSlug()))
        ->setCredentials(array('facilityAdmin','regionAdmin','siteAdmin'));
  $menu['group management']->addChild('manage registration',    @group_register     )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('facilityAdmin'));
  $menu['group management']->addChild('manage registrations',   @group_register     )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  // facility staff menu
  $menu['class management']->addChild('class list',             @report_class_enroll)
        ->setCredentials(array('facilityStaff'));
  $menu['class management']->addChild('log attendance',         @class_attendance   )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getZone()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),
                              'week_slug'         =>            $user->getActiveEnrollment()->getWeek()->getSlug(),
                              'class_slug'        =>            $request->getParameter('class_slug')))
        ->setCredentials(array('facilityStaff'));
  // staff info menu
  $menu['staff information']->addChild('night out request',     @form_night_out     )
        ->setCredentials(array('facilityStaff'));
  $menu['staff information']->addChild('housing change request',@form_cabin_change  )
        ->setCredentials(array('facilityStaff'));
  // facility settings menu
  $menu['facility settings']->addChild('manage classes',            @classes_by_facility    )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),
                              'week_slug'         =>            $user->getActiveEnrollment()->getWeek()->getSlug()))
        ->setCredentials(array('facilityAdmin'));
  $menu['facility settings']->addChild('manage group quarters',          @groupquarters_by_facility  )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('facilityAdmin'));
  $menu['facility settings']->addChild('manage cabins',             @facultyquarters_by_facility     )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('facilityAdmin'));
  $menu['facility settings']->addChild('manage areas',              @areas_by_facility      )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('facilityAdmin'));
  $menu['facility settings']->addChild('facility details',              @facility_edit          )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('facilityAdmin'));          
  // facility management menu
  $menu['facility management']->addChild('manage classes',          @classes_by_facility    )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug(),
                              'week_slug'         =>            $user->getActiveEnrollment()->getWeek()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  $menu['facility management']->addChild('manage areas',            @areas_by_facility      )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));          
  $menu['facility management']->addChild('manage group quarters',        @groupquarters_by_facility  )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  $menu['facility management']->addChild('manage cabins',           @facultyquarters_by_facility     )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  $menu['facility management']->addChild('manage staff',            @staff_by_facility      )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  $menu['facility management']->addChild('facility details',            @facility_edit          )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getTroop()->getregion()->getSlug(),
                              'facility_slug'         =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getSlug()))
        ->setCredentials(array('regionAdmin','siteAdmin'));
  // region settings menu
  $menu['region settings']->addChild('manage facilitys',          @facility_by_region  )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getSlug()))
        ->setCredentials(array('regionAdmin'));
  $menu['region settings']->addChild('region details',      @region_edit      )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getSlug()))
        ->setCredentials(array('regionAdmin'));
  // region management menu
  $menu['region management']->addChild('manage facilitys',        @facility_by_region  )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getSlug()))
        ->setCredentials(array('siteAdmin'));
  $menu['region management']->addChild('region details',    @region_edit      )
        ->setParameters(array('region_slug'     =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getSlug()))
        ->setCredentials(array('siteAdmin'));
  // misc settings menu
  $menu['misc settings']->addChild('manage regions',          @region           )
          ->setCredentials(array('siteAdmin'));
//  $menu['misc settings']->addChild('manage zones',              @zone               )
//        ->setParameters(array('country_slug'      =>            $user->getActiveEnrollment()->getWeek()->getFacility()->getregion()->getZone()->getCountry()->getSlug()))
//        ->setCredentials(array('siteAdmin'));
//  $menu['misc settings']->addChild('manage countries',          @country            )
//        ->setCredentials(array('siteAdmin'));;
  //$menu['misc settings']->addChild('language settings',         @);
  //$menu['misc settings']->addChild('site settings',             @);
  // reports menu
  $menu['reports']->addChild('meritbadge form',                 @forms_mb           )
        ->requiresAuth(true);
  $menu['reports']->addChild('alphabetical list',               @report_alpha       )
        ->setCredentials(array('groupAdmin','facilityAdmin'));
  $menu['reports']->addChild('list by patrol',                  @report_by_patrol   )
        ->setCredentials(array('groupAdmin','facilityAdmin','regionAdmin','siteAdmin'));
  $menu['reports']->addChild('sm master schedule',              @report_sm_master   )
        ->setCredentials(array('groupAdmin','facilityAdmin','regionAdmin','siteAdmin'));
  $menu['reports']->addChild('staff list',                      @report_staff       )
        ->setCredentials(array('facilityAdmin','regionAdmin','siteAdmin'));
  $menu['reports']->addChild('class list',                      @report_class       )
        ->setCredentials(array('facilityAdmin','regionAdmin','siteAdmin'));

        return $menu;
    }

    /**
     * Navigation menu for a non auth'd user (guest)
     * 
     * @param Request $request
     * @return MenuItem $menu 
     */
    public function nonauthMenu(Request $request) {
      $menu = $this->factory->createItem('nonauth');
      $menu->addChild('home',     array('route' => 'homepage'));
      $menu->addChild('sign in',  array('route' => 'fos_user_security_login'));
      $menu->addChild('sign up',  array('route' => 'fos_user_security_register'));
      $menu->addChild('about',    array('route' => 'about'));
      $menu->addChild('contact',  array('route' => 'contact'));
      return $menu;
    }
    
    public function groupUserMenu(Request $request) {
      $user = $this->container->get('security.context')->getToken()->getUser();
      $menu = $this->factory->createItem('groupUser');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));
      // attendee mgmt =========================================================================================================================================================================
      $menu->addChild('attendee managment', array('route'           =>  'attendee_by_group',
                                                  'routeParameters' =>  array('region_slug'   =>  $this->user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                              'group_slug'    =>  $this->user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['attendee management']->addChild('add attendee',        array('route'             =>  'attendee_new',
                                                                    'routeParameters'         =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                                                        'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['attendee management']->addChild('manage attendees',    array('route'             =>  'attendee_by_group',
                                                                        'routeParameters'     =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                                                        'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['attendee management']->addChild('attendee enrollment', array('route'             =>  'attendee_enrollment'));
      // subgroup mgmt =========================================================================================================================================================================
      $menu->addChild('subgroup managment', array('route'           =>  'subgroup_by_group',
                                                  'routeParameters' =>  array('region_slug'   =>  $this->user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                              'group_slug'    =>  $this->user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['subgroup management']->addChild('add subgroup',        array('route'             =>  'subgroup_new',
                                                                    'routeParameters'         =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                                                        'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['subgroup management']->addChild('manage subgroup',     array('route'             =>  'subgroup_by_group',
                                                                          'routeParameters'   =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                                                        'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      // group settings ========================================================================================================================================================================
      $menu->addChild('group settings',     array('route'           =>  'group',
                                                  'routeParameters' =>  array('region_slug'   =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                              'group_slug'    =>   $user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['group settings']->addChild('photo gallery',            array('route'             =>  'subgroup_new',
                                                                          'routeParameters'   =>  array('region_slug'     =>   $user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                                                        'group_slug'      =>   $user->getActiveEnrollment()->getTroop()->getSlug())));      
      // group menrollment =====================================================================================================================================================================
      $menu->addChild('group enrollment',   array('route'           =>  'group_enrollment',
                                                  'routeParameters' =>  array('region_slug'   =>  $this->user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(), 
                                                                              'group_slug'    =>  $this->user->getActiveEnrollment()->getTroop()->getSlug())));
      $menu['group enrollment']->addChild('next season',            array('route'             =>  'next_season',
                                                                          'routeParameters'   =>  array('region_slug'   =>  $this->user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(),
                                                                                                        'facility_slug' =>  $this->user->getActiveEnrollment()->getFacility()->getSlug())));
      $menu['group enrollment']->addChild('payments',               array('route'             =>  'group_payments',
                                                                          'routeParameters'   =>  array('region_slug'   =>  $this->user->getActiveEnrollment()->getTroop()->getRegion()->getSlug(),
                                                                                                        'group_slug'    =>  $this->user->getActiveEnrollment()->getTroop()->getSlug())));
      return $menu;
    }
    
    public function createFacultyUserMenu(Request $request) {
      $menu = $this->factory->createItem('facultyUSer');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));      
      
      return $menu;
    }
    
    public function createFacilityAdminMenu(Request $request) {
      $menu = $this->factory->createItem('facilityAdmin');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));
      
      return $menu;
    }
    
    public function createOrganizationAdminMenu(Request $request) {
      $menu = $this->factory->createItem('OrganizationAdmin');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));
      
      return $menu;
    }
    
    public function createRegionAdminMenu(Request $request) {
      $menu = $this->factory->createItem('regionAdmin');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));
      
      return $menu;
    }
    
    public function createAdminMenu(Request $request) {
      $menu = $this->factory->createItem('admin');
      $menu->addChild('dashboard',          array('route'           =>  'dashboard'));
      
      return $menu;
    }
}