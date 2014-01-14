<?php
namespace SCSS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SCSS\UtilityBundle\Entity\Carousel;
use SCSS\UtilityBundle\Entity\CarouselItem;

class UserController extends Controller
{
    protected $available_roles = array();

    /**
     * Index
     * 
     * @param integer $pager1 pager1 page
     * @param integer $pager2 pager2 page
     * 
     * @Route("/", name="homepage")
     * @Template("SCSSUserBundle:User:index.html.twig")
     * @return  array 
     */
    public function indexAction($pager1 = 1, $pager2 = 1)
    {
        
        /**
         * If the user is atleast authenticated
         * with the system then we can continue.
         */
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $session = $this->get('security.context');
            if ($session->isGranted('ROLE_ADMIN')) {
                $this->forwardToDashboard(($session->isGranted(' ROLE_SUPER_ADMIN') ? 'ROLE_SUPER_ADMIN' : 'ROLE_ADMIN'));
            } elseif ($session->isGranted('ROLE_REGION_USER')) {
                $this->forwardToDashboard(($session->isGranted(' ROLE_REGION_ADMIN') ? 'ROLE_REGION_ADMIN' : 'ROLE_REGION_USER'));
            } elseif ($session->isGranted('ROLE_ORG_USER')) {
                $this->forwardToDashboard(($session->isGranted(' ROLE_ORG_ADMIN') ? 'ROLE_ORG_ADMIN' : 'ROLE_ORG_USER'));
            } elseif ($session->isGranted('ROLE_FACILITY_ADMIN ')) {
                $this->forwardToDashboard(($session->isGranted(' ROLE_FACILITY_ADMIN') ? 'ROLE_FACILITY_ADMIN' : ($session->isGranted('ROLE_FACILITY_FACULTY') ? 'ROLE_FACILITY_FACULTY' : 'ROLE_FACILITY_USER')));
            } elseif ($session->isGranted('ROLE_PASSEL_USER')) {
                $this->forwardToDashboard(($session->isGranted(' ROLE_PASSEL_ADMIN') ? 'ROLE_PASSEL_ADMIN' : ($session->isGranted('ROLE_PASSEL_LEADER') ? 'ROLE_PASSEL_LEADER' : 'ROLE_PASSEL_USER')));
            }
        }

        $carousel = new Carousel();
        $carousel->setName('splash page');
        $item1 = new CarouselItem();
        $item1->setName('img1');
        $item1->setImage('/bundles/scssutility/images/carousel/item1.jpg');
        $item1->setCaption('item1');
        $carousel->addItem($item1);
        $item2 = new CarouselItem();
        $item2->setName('img1');
        $item2->setImage('/bundles/scssutility/images/carousel/item2.jpg');
        $item2->setCaption('item2');
        $item3 = new CarouselItem();
        $carousel->addItem($item2);
        $item3->setName('img1');
        $item3->setImage('/bundles/scssutility/images/carousel/item3.jpg');
        $item3->setCaption('item3');
        $carousel->addItem($item3);

        // last username entered by the user
        $lastUsername = '';//($this->get('security.context')->isGranted('ROLE_USER')) ? '' : $this->get('security.context')->isGranted('ROLE_USER')->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return array(
            'carousel' => $carousel,
            'csrf_token' => $csrfToken,
            'last_username' => $lastUsername
        );
    }

    /**
     * Forward to dashboard
     * 
     * @param string $role role
     */
    private function forwardToDashboard($role)
    {
        /**
         * @todo find a cleaner way to match the role to the controller
         */
        $roleEntities = array(
            'ROLE_PASSEL_USER'          =>  'SCSSOrganizationBundle:Attendee:dashboard',
            'ROLE_PASSEL_LEADER'        =>  'SCSSOrganizationBundle:PasselLeader:dasboard',
            'ROLE_PASSEL_ADMIN'         =>  'SCSSOrganizationBundle:PasselLeader:dasboard',
            'ROLE_FACILITY_USER'        =>  'SCSSFacilityBundle:Faculty:dashboard',
            'ROLE_FACILITY_FACULTY'     =>  'SCSSFacilityBundle:Faculty:dashboard',
            'ROLE_FACILITY_ADMIN'       =>  'SCSSFacilityBundle:Faculty:dashboard',
            'ROLE_ORG_USER'             =>  'SCSSOrganizationBundle:Organization:dashboard',
            'ROLE_ORG_ADMIN'            =>  'SCSSOrganizationBundle:Organization:dashboard',
            'ROLE_REGION_USER'          =>  'SCSSGeographyBundle:Region:dashboard',
            'ROLE_REGION_ADMIN'         =>  'SCSSGeographyBundle:Region:dashboard',
            'ROLE_ADMIN'                =>  'SCSSUserBundle:Admin:dashboard',
            'ROLE_SUPER_ADMIN'          =>  'SCSSUserBundle:Admin:dashboard'
        );
        $this->forward($roleEntities[ $role ]);
    }

    public function registerAction()
    {
        $form = $this->createForm(
            new RegistrationType(),
            new Registration()
        );

        return $this->render(
            'SCSSUserBundle:User:register.html.twig',
            array('form'  =>  $form->createView())
        );
    }

    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $registration = $form->getData();

            $em->persist($registration->getUser());
            $em->flush();

            return $this->redirect('SCSSUserBundle:User:dashboard');
        }

        return $this->render(
            'SCSSUserBundle:User:register.html.twig',
            array('form'  =>  $form->createView())
        );
    }

    public function aboutAction()
    {
        return $this->render('SCSSUserBundle:Base:about.html.twig');
    }

    public function helpAction()
    {
        return $this->render('SCSSUserBundle:Base:help.html.twig');
    }

    public function contactAction()
    {
        return $this->render('SCSSUserBundle:Base:contact.html.twig');
    }
}
