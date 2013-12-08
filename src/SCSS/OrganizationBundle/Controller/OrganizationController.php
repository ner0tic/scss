<?php
namespace SCSS\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\OrganizationBundle\Entity\Organization;
use SCSS\OrganizationBundle\Form\Type\OrganizationType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class OrganizationController extends Controller
{
    /**
     * @Route("/", name="scss_organization_index")
     * @Template("SCSSOrganizationBundle:Organization:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSOrganizationBundle:Organization')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'organizations' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_organization_show")
     * @Template("SCSSOrganizationBundle:Organization:show.html.twig")
     */
    public function showAction($slug)
    {
        $organization = $this->getDoctrine()
            ->getRepository('SCSSOrganizationbundle:Organization')
            ->findOneBySlug($slug);

        if (!$organization) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching organization found.'
                );
            $this->redirect($this->generateUrl('scss_organization_index'));
        }

        return array('organization' => $organization);
    }

    /**
     * @Route("/new", name="scss_organization_new")
     * @Template("SCSSOrganizationbundle:Organization:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $organization = new Organization();
        $form = $this->createForm(new OrganizationType(), $organization);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($organization);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'organization created.'
                );

                return $this->render(
                    'SCSSOrganizationbundle:Organization:show.html.twig',
                    array(
                        'organization' => $organization
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
