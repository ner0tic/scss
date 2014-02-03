<?php
namespace SCSS\UtilityBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder implements ContainerAwareInterface
{
    /**
     * @param User $user
     */
    private $user;

    /**
     * @param  FactoryInterface $factory
     */
    private $factory;

    /**
     * @param ContainerInterface $container
     */
    protected $container;

    /**
     * Constructor
     * 
     * @param FactoryInterface $factory factory
     * @param ContainerInterface $container container
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->user = $this->container->get('security.context')->getToken()->getUser();
    }

    /**
     * @param ContainerInterface $container container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Navigation root menu for auth'd user (attendee, passel_leader,
     * passel_admin, facility_user, faculty, facility_admin, region_user,
     * region_admin, organization_user, organization_admin)
     *
     * @param  Symfony\Component\HttpFoundation\Request $request
     * @return MenuItem                                 $menu
     */
    public function createMainMenu(Request $request, ContainerInterface $container)
    {
        if ($this->user->isGranted('ROLE_AUTHENTICATED_ANONYMOUSLY')) {
            return $this->createNonauthMenu($request);
        }

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild(
            'home',
            array('route' => 'homepage')
        );

        $menu->addChild($this->activeEnrollmentMenu($request));

        if ($this->user->isGranted('ROLE_ADMIN')) {
            /////////////////////////////////////////////////////////
            ///ADMIN MENU////////////////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Organizations
             */
            $menu->addChild('organizations')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');
            $menu['organizations']->addChild(
                'list organizations',
                array('route' => 'scss_organization_index')
            );
            $menu['organizations']->addChild(
                'add an organization',
                array('route' => 'scss_organization_new')
            );

            /**
             * Passels
             */
            $menu->addChild('passels')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');
            $menu['passels']->addChild(
                'list passels',
                array('route' => 'scss_passel_index')
            );
            $menu['passels']->addChild(
                'add a passel',
                array('route' => 'scss_passel_new')
            );

            /**
             * Facilities
             */
            $menu->addChild('facilities')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');
            $menu['facilities']->addChild(
                'list facilities',
                array('route' => 'scss_facility_index')
            );
            $menu['facilities']->addChild(
                'add a facility',
                array('route' => 'scss_facility_new')
            );
        } elseif ($this->user->isGranted('ROLE_ORG_USER')) {
            /////////////////////////////////////////////////////////
            ///ORGANIZATION USER MENU////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Organization Management
             */
            $menu->addChild('organization management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['organization management']->addChild(
                'councils',
                array(
                    'route' => 'scss_council_by_organization_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getOrganization()->getSlug())
                )
            );

            $menu['organization management']->addChild(
                'regions',
                array(
                    'route' => 'scss_region_by_organization_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getOrganization()->getSlug())
                )
            );

            $menu['organization management']->addChild(
                'facilities',
                array(
                    'route' => 'scss_facility_by_organization_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getOrganization()->getSlug())
                )
            );

            $menu['organization management']->addChild(
                'passels',
                array(
                    'route' => 'scss_passel_by_organization_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getOrganization()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_COUNCIL_USER')) {
            /////////////////////////////////////////////////////////
            ///COUNCIL USER MENU/////////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Council Management
             */
            $menu->addChild('council management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['council management']->addChild(
                'regions',
                array(
                    'route' => 'scss_region_by_council_index',
                    'routeParameters' => array('alug' => $this->user->getActiveEnrollment()->getCouncil()->getSlug())
                )
            );

            $menu['council management']->addChild(
                'facilities',
                array(
                    'route' => 'scss_facility_by_council_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getCouncil()->getSlug())
                )
            );
            
            $menu['council management']->addChild(
                'passels',
                array(
                    'route' => 'scss_passel_by_council_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getCouncil()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_REGION_USER')) {
            /////////////////////////////////////////////////////////
            ///REGION USER MENU//////////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Region Management
             */
            $menu->addChild('region management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['region management']->addChild(
                'facilities',
                array(
                    'route' => 'scss_facility_by_region_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getRegion()->getSlug())
                )
            );
            
            $menu['region management']->addChild(
                'passels',
                array(
                    'route' => 'scss_passel_by_region_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getRegion()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_FACILITY_ADMIN')) {
            /////////////////////////////////////////////////////////
            ////FACILITY ADMIN MENU//////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Facility Management
             */
            $menu->addChild('facility management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['facility management']->addChild(
                'quarters',
                array(
                    'route' => 'scss_quarters_by_facility_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getFacility()->getSlug())
                )
            );
            
            $menu['facility management']->addChild(
                'faculty',
                array(
                    'route' => 'scss_faculty_by_facility_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getFacility()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_FACILITY_FACULTY')) {
            /////////////////////////////////////////////////////////
            ///FACULTY USER MENU/////////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Faculty Management
             */
            $menu->addChild('class management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['class management']->addChild(
                'record attendence',
                array(
                    'route' => 'scss_class_attendence',
                    'routeParameters' => array('slug' => $this->user->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_PASSEL_ADMIN')) {
            /////////////////////////////////////////////////////////
            ////PASSEL ADMIN MENU////////////////////////////////////
            /////////////////////////////////////////////////////////
            
            /**
             * Passel Management
             */
            $menu->addChild('passel management')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

            $menu['passel management']->addChild(
                'factions',
                array(
                    'route' => 'scss_faction_by_passel_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getPassel()->getSlug())
                )
            );
            
            $menu['passel management']->addChild(
                'attendees',
                array(
                    'route' => 'scss_attendee_by_passel_index',
                    'routeParameters' => array('slug' => $this->user->getActiveEnrollment()->getPassel()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_PASSEL_USER')) {
            // attendee custom menu options here.
        }

        $menu->addChild($this->reportMenu($request));
        $menu->addChild($this->profileMenu($request));
        
        /////////////////////////////////////////////////////////
        ////AUTH MENU////////////////////////////////////////////
        /////////////////////////////////////////////////////////
        if ($this->user->isGranted('ROLE_USER')) {
            $menu->addChild(
                'sign out',
                array('route' => 'fos_user_security_logout')
            );
        } else {
            $menu->addChild(
                'sign up',
                array('route' => 'fos_user_register_index')
            );

            $menu->addChild(
                'sign in',
                array('route' => 'fos_user_security_login')
            );
        }

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
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild(
            'home',
            array('route' =>  'homepage')
        );

        $menu->addChild(
            'sign in',
            array('route' =>  'fos_user_security_login')
        );

        $menu->addChild(
            'sign up',
            array('route' =>  'fos_user_register_index')
        );

        $menu->addChild(
            'about',
            array('route' => 'about')
        );

        $menu->addChild(
            'contact',
            array('route' => 'contact')
        );

        return $menu;
    }

    /**
     * @param Request $request request
     * @return MenuItem 
     */
    public function reportMenu(Request $request)
    {
        $menu = $this->factory->createItem('reports')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

        return $menu;
    }

    /**
     * @param Request $request request
     * @return MenuItem 
     */
    public function profileMenu(Request $request)
    {
        $menu = $this->factory->createItem('profile')
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'icon-user');

        $menu->addChild(
            'view profile',
            array(
                'route' => 'fos_user_profile_show',
                'routeParameters' => array(
                    'slug' => $this->user->getSlug()
                )
            )
        );

        $menu->addChild(
            'edit profile',
            array(
                'route' => 'fos_user_profile_edit',
                'routeParameters' => array(
                    'slug' => $this->user->getSlug()
                )
            )
        );

        $menu->addChild(
            'change password',
            array('route' => 'fos_user_change_password')
        );
    }

    /**
     * @param Request $request request
     * @return MenuItem 
     */
    public function activeEnrollmentMenu(Request $request)
    {
        $enrollment = $this->user->getActiveEnrollment();

        $label = array(
            $this->user->getUserName().' @ '.
            $enrollment->getName().' - '.
            $enrollment->getWeek()->getShortName(),
            $enrollment->getRegion()->getCode().
            $enrollment->getPassel()->getName().' @ '.
            $enrollment->getFacility()->getName(). ' - '.
            $enrollment->getWeek()->GetShortName()
        );

        // Generate menu with corresponding label
        if ($this->user->isGranted(
            new Expression('"ROLE_PASSEL_ADMIN" or "ROLE_PASSEL_LEADER" or "ROLE_PASSEL_USER" in roles')
        )) {
            $menu = $this->factory->createItem($label[1]);
        } else {
            $menu = $this->factory->createItem($label[0]);
        }
        $menu->setAttribute('dropdown', true)
            ->setAttribute('icon', 'icon-user');

        // quick switchers
        $menu->addChild(
            'change week',
            array('route' => 'scss_active_enrollment_week')
        );

        $menu->addChild(
            'change facility',
            array('route' => 'scss_active_enrollment_facility')
        );

        if ($this->user->isGranted('ROLE_FACILITY_ADMIN')) {
            $menu->addChild(
                'change passel',
                array('route' => 'scss_active_enrollment_passel')
            );
        }

        if ($this->user->isGranted('ROLE_COUNCIL_ADMIN')) {
            $menu->addChild(
                'change region',
                array('route' => 'scss_active_enrollment_region')
            );
        }

        if ($this->user->isGranted('ROLE_ORG_ADMIN')) {
            $menu->addChild(
                'change council',
                array('route' => 'scss_active_enrollment_council')
            );
        }

        if ($this->user->isGranted('ROLE_ADMIN')) {
            $menu->addChild(
                'change organization',
                array('route' => 'scss_active_enrollment_organization')
            );
        }

        // Attendee enrollment
        if ($this->user->isGranted('ROLE_PASSEL_USER')) {
            $menu->addChild(
                'enroll',
                array(
                    'route' => 'scss_attendee_enrollment_index',
                    'routeParameters' => array('attendee_slug' => $this->user->getSlug())
                )
            );
        } elseif (!$this->user->isGranted(
            new Expression('"ROLE_FACILITY_FACULTY" or "ROLE_FACILITY_USER" in roles')
        )) {
            $menu->addChild(
                'enroll attendees',
                array(
                    'route' => 'scss_attendee_enrollment_index',
                    'routeParameters' => array('passel_slug' => $enrollment->getPassel())
                )
            );
        }

        // Passel enrollment
        if ($this->user->isGranted('ROLE_REGION_ADMIN')) {
            $menu->addChild(
                'enroll passels',
                array(
                    'route' => 'scss_passel_enrollment_index',
                    'routeParameters' => array('facility_slug' => $enrollment->getFacility()->getSlug())
                )
            );
        } elseif ($this->user->isGranted('ROLE_PASSEL_ADMIN')) {
            $menu->addChild(
                'enroll passel',
                array(
                    'route' => 'scss_passel_enrollment_index',
                    'routeParameters' => array(
                        'facility_slug' => $enrollment->getFacility()->getSlug(),
                        'passel_slug' => $enrollment->getPassel()->getSlug()
                    )
                )
            );
        }
    }
}
