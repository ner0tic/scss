<?php
namespace SCSS\UtilityBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder extends ContainerAware
{
    protected $user;

    /**
     * @param  FactoryInterface $factory
     */
    private $factory;


    /**
     * @param SecurityContext $securityContext
     */
    private $securityContext;

    /**
     * Constructor
     * 
     * @param FactoryInterface $factory factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
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
        $this->securityContext = $container->get('security.context');

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->addChild(
            'home',
            array(
                'route'             =>    'homepage'
            )
        );

        $menu->addChild(
            'profile',
            array(
                'route'             =>    'user_show',
                'routeParameters' =>    array(
                    'user_slug'   =>    $user->getSlug()
                )
            )
        );

        $menu['profile']->addChild(
            'edit',
            array(
                'route'             =>    'user_profile_edit',
            )
        );

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
            array(
                'route' =>  'homepage'
            )
        );

        $menu->addChild(
            'sign in',
            array(
                'route' =>  'fos_user_security_login'
            )
        );

        $menu->addChild(
            'sign up',
            array(
                'route' =>  'fos_user_registration_register'
            )
        );

        $menu->addChild(
            'about',
            array(
                'route'           =>  'about'
            )
        );

        $menu->addChild(
            'contact',
            array(
                'route'           =>  'contact'
            )
        );

        return $menu;
    }

    public function createDatatableControlMenu(Request $request, ContainerInterface $container)
    {
        $this->securityContext = $container->get('security.context');

        $menu = $this->factory->createItem('root');

        $menu->setChildrenAttribute('class', 'nav datatable-controls');

        $menu->addChild(
            "<i class=\"fa fa-view fa-large pull-left\"></i>preview",
            array('route'=>'homepage')
        );

        if ($this->securityContext->isGranted('ROLE_DEVELOPER_ADMIN')) {
            $menu->addChild(
                "<i class=\"fa fa-edit fa-large pull-left\"></i>edit",
                array('route'=>'homepage')
            );

            $menu->addChild(
                "<i class=\"fa fa-trash fa-large pull-left\"></i>remove",
                array('route' => 'homepage')
            );
        }

        return $menu;
    }
}
