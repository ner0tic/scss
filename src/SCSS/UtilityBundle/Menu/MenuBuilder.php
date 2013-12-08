<?php
namespace SCSS\UtilityBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder implements ContainerAwareInterface
{
    protected $activeEnrollLabel;

    public function __construct(FactoryInterface $factory, ContainerInterface $container = null)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->user = $this->container->get('security.context')->getToken()->getUser();
    }

    public function setContainer(ContainerInterface $container = NULL)
    {
        $this->container = $container;
    }

    public function createSuperAdminMenu(Request $request)
    {
        $menu = $this->createAdminMenu($request);
        $menu->addChild('site mgmt',                       array(
            'route'               =>  'site-mgmt'
       ));
    }

    public function createAdminMenu(Request $request)
    {
    }

    public function createOrganizationMenu(Request $request) {}

    public function createFacilityMenu(Request $request)
    {
        $menu = $this->createBaseMenu($request);

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
                    'route'                   =>  'weeks_by_facility',
                    'routeParameters'       =>  array(
                        'region_slug'       =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getRegion()
                                                     ->getSlug(),
                        'facility_slug'     =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
       )));

        foreach ($user->getActiveEnrollment()->getFacility()->getWeeks() as $week) {
            if ($week->getId() != $user->getActiveEnrollment()->getWeek()->getId()) {
                $menu[ $this->activeEnrollLabel ]->addChild(
                        $user->getActiveEnrollment()->getFacility() . ' ' . $week,
                        array(
                            'route'               =>  'change-active-week',
                            'routeParamters'    =>  array(
                                'region_slug'       =>  $user->getActiveEnrollment()
                                                             ->getFacility()
                                                             ->getRegion()
                                                             ->getSlug(),
                                'facility_slug'     =>  $user->getActiveEnrollment()
                                                             ->getFacility()
                                                             ->getSlug(),
                                'week_slug'         =>  $week->getSlug()
               )));
            }
        }

        ////////////////////////////////////////////////////////////////////
        // Class Mgmt Menu Item
        ////////////////////////////////////////////////////////////////////
        $menu->addChild(
                'class management',
                array(
                    'route'                   =>  'class_mgmt',
                    'routeParameters'       =>  array(

       )));

        ////////////////////////////////////////////////////////////////////
        // Reports
        ////////////////////////////////////////////////////////////////////
        $menu->addChild(
                'reports',
                array(
                    'route'                   =>  'reports',
       ));

        ////////////////////////////////////////////////////////////////////////
        // Faculty Admin Menu Additions
        ////////////////////////////////////////////////////////////////////////
        if ($user->isGranted('ROLE_FACULTY_ADMIN')) {
            $menu[ $this->activeEnrollLabel ]->addChild(
            'passel enrollments',
            array(
                'route'                   =>  'passel_enrollments',
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
           )));
            ////////////////////////////////////////////////////////////////////
            // Facility Mgmt Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'facility management',
                    array(
                        'route'                   =>  'facility_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage weeks',
                    array(
                        'route'                   =>  'week_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage departments',
                    array(
                        'route'                   =>  'dept_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage quarters',
                    array(
                        'route'                   =>  'quarters_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage faculty',
                    array(
                        'route'                   =>  'faculty_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage periods',
                    array(
                        'route'                   =>  'period_mgmt',
                        'routeParameters'       =>  array(
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getRegion()
                                                         ->getSlug(),
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug()
           )));

            $menu[ 'facility management' ]->addChild(
                    'manage classes',
                    array(
                        'route'                   =>  'class_mgmt',
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
           )));
        }

    return $menu;
    }

    /*
     * Passel Related Role Menu
     *
     * @param  Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem                                 $menu
     */
    public function createPasselMenu(Request $request)
    {
        $menu = $this->createBaseMenu($request);

        $this->activeEnrollLabel = $user->getActiveEnrollment()->getFacility() . ' - ' . $user->getActiveEnrollment()->getWeek();

        ////////////////////////////////////////////////////////////////////////
        // Passel Leader Menu
        ////////////////////////////////////////////////////////////////////////
        if ($user->isGranted('ROLE_PASSEL_LEADER')) {
            ////////////////////////////////////////////////////////////////////
            // Active Enrollment Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    $this->activeEnrollLabel,
                    array(
                        'route'               =>  'passel_enrollment_show',
                        'routeParameters'   =>  array(
                            'id'            =>  $user->getActiveEnrollment()
                                                     ->getPasselEnrollmentId()
           )));

            foreach ($user->getActiveEnrollment()->getPassel()->getEnrollments() as $enrollment) {
                $menu[ $this->activeEnrollLabel ]->addChild(
                        $enrollment()->getFacility() . ' - ' . $enrollment()->getWeek(),
                        array(
                            'route'               =>  'change-enrollment',
                            'routeParameters'   =>  array(
                                'facility_slug' =>  $enrollment()->getFacility()->getSlug(),
                                'week_slug'     =>  $enrollment()->getWeek()->getSlug(),
               )));
            }

            ////////////////////////////////////////////////////////////////////
            // Passel Mgmt Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'passel management',
                    array(
                        'route'               =>  'attendee_mgmt',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollmenr()
                                                     ->getPassel()
                                                     ->getSlug(),
           )));

            $menu[ 'passel management' ]->addChild(
                    'enrollment',
                    array(
                        'route'               =>  'attendee_enrollment',
                        'routeParameter'    =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getSlug(),
           )));

            $menu[ 'passel management' ]->addChild(
                    'manage factions',
                    array(
                        'route'               =>  'faction_mgmt',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'passel_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getSlug(),
           )));

            ////////////////////////////////////////////////////////////////////
            // Reports Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'reports',
                    array(
                        'route'               =>  'reports',
           ));

            $menu[ 'reports' ]->addChild(
                    'alphabetical list',
                    array(
                        'route'               =>  'reports_alpha',
                        'routeParameters'   =>  array(
                            'region_slug'   =>  $user->getActiveEnrollment()
                                                     ->getPassel()
                                                     ->getRegion()
                                                     ->getSlug(),
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
           )));

            $menu[ 'reports' ]->addChild(
                    'medlist',
                    array(
                        'route'               =>  'report_medlist',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),
           )));

            $menu[ 'reports' ]->addChild(
                    'master schedule',
                    array(
                        'route'               =>  'report_master_sched',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),
           )));

            $menu[ 'reports' ]->addChild(
                    'incomplete attendee schedules',
                    array(
                        'route'               =>  'report_inc_attendees',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),
           )));

            ////////////////////////////////////////////////////////////////////
            // Passel Admin Menu Additions
            ////////////////////////////////////////////////////////////////////
            if ($user->isGranted('ROLE_PASSEL_ADMIN')) {
                $menu[ 'profile' ]->addChild(
                        'promote leader',
                        array(
                            'route'               =>  'promote_leader',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
               )));

                $menu[ $this->activeEnrollLabel ]->addChild(
                        'enroll in a facility',
                        array(
                            'route'               =>  'passel_enrollment_new',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
               )));

                $menu->addChild(
                        'passel leader management',
                        array(
                            'route'               =>  'passel_leader_mgmt',
                            'routeParameters'   =>  array(
                                'region_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug(),
                                'passel_slug'   =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
               )));
            }

        }
        ////////////////////////////////////////////////////////////////////////
        // Attendee Menu
        ////////////////////////////////////////////////////////////////////////
        else if ($user->isGranted('ROLE_PASSEL_USER')) {
            ////////////////////////////////////////////////////////////////////
            // Active Enrollment Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    $this->activeEnrollLabel,
                    array(
                        'route'               =>  'passel_enrollment_show',
                        'routeParameters'   =>  array(
                            'id'            =>  $user->getActiveEnrollment()
                                                     ->getPasselEnrollmentId()
           )));

            $menu[ $this->activeEnrollLabel ]->addChild(
                    'enroll',
                    array(
                        'route'               =>  'attendee_enrollment_new',
                        'routeParameters'   =>  array(
                            'facility_slug' =>  $user->getActiveEnrollment()
                                                     ->getFacility()
                                                     ->getSlug(),
                            'week_slug'     =>  $user->getActiveEnrollment()
                                                     ->getWeek()
                                                     ->getSlug(),
           )));

            $menu[ $this->activeEnrollLabel ]->addChild(
                    'mealplan',
                    array(
                        'route'               =>  'mealplan',
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
                        'route'               =>  'packing-list',
                        'routeParameters'   =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
           )));

            $menu[ $this->activeEnrollLabel ]->addChild(
                    'change facilities',
                    array(
                        'route'                   =>  'passel_enrollments_by_passel',
                        'routeParamters'        =>  array(
                            'passel_slug'       =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getSlug(),
                            'region_slug'       =>  $user->getActiveEnrollment()
                                                         ->getPassel()
                                                         ->getRegion()
                                                         ->getSlug()
           )));

            ////////////////////////////////////////////////////////////////////
            // Med List Menu Item
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'med list',
                    array(
                        'route'                   =>  'medlist',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
           )));

            $menu[ 'medlist' ]->addChild(
                    'add item',
                    array(
                        'route'                   =>  'medlist_new',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
           )));

            ////////////////////////////////////////////////////////////////////
            // Reports
            ////////////////////////////////////////////////////////////////////
            $menu->addChild(
                    'reports',
                    array(
                        'route'                   =>  'reports',
           ));

            $menu[ 'reports' ]->addChild(
                    'schedule',
                    array(
                        'route'                   =>  'report_attendee_schedule',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
           )));

            $menu[ 'reports' ]->addChild(
                    'medlist',
                    array(
                        'route'                   =>  'report_medlist',
                        'routeParameters'       =>  array(
                            'facility_slug'     =>  $user->getActiveEnrollment()
                                                         ->getFacility()
                                                         ->getSlug(),
                            'week_slug'         =>  $user->getActiveEnrollment()
                                                         ->getWeek()
                                                         ->getSlug(),
           )));
        }

        return $menu;
    }

    /**
     * Navigation root menu for auth'd user (attendee, passel_leader,
     * passel_admin, facility_user, faculty, facility_admin, region_user,
     * region_admin, organization_user, organization_admin)
     *
     * @param  Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem                                 $menu
     */
    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild(
                'home',
                array(
                    'route'             =>    'homepage'
       ));

        $menu->addChild(
                'profile',
                array(
                    'route'             =>    'user_show',
                    'routeParameters' =>    array(
                        'user_slug'   =>    $user->getSlug()
       )));

        $menu[ 'profile' ]->addChild(
                'edit',
                array(
                    'route'             =>    'user_profile_edit',

       ));

        return $menu;
    }

    /**
     * Navigation menu for a non auth'd user (guest)
     *
     * @param  Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem                                 $menu
     */
    public function createNonauthMenu(Request $request)
    {
        $menu = $this->factory->createItem('nonauth');
        $menu->addChild(
                'home',
                array(
                    'route'           =>  'homepage'
       ));

        $menu->addChild(
                'sign in',
                array(
                    'route'           =>  'fos_user_security_login'
       ));

        $menu->addChild(
                'sign up',
                array(
                    'route'           =>  'fos_user_registration_register'
       ));

        $menu->addChild(
                'about',
                array(
                    'route'           =>  'about'
       ));

        $menu->addChild(
                'contact',
                array(
                    'route'           =>  'contact'
       ));

        return $menu;
    }
}
