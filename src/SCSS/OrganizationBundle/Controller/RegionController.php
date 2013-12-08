<?php
namespace SCSS\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\OrganizationBundle\Entity\Region;
use SCSS\OrganizationBundle\Form\Type\RegionType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class RegionController extends Controller
{
    /**
     * @Route("/", name="scss_region_index")
     * @Template("SCSSOrganizationBundle:Region:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSOrganizationBundle:Region')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'regions' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_region_show")
     * @Template("SCSSOrganizationBundle:Region:show.html.twig")
     */
    public function showAction($slug)
    {
        $region = $this->getDoctrine()
            ->getRepository('SCSSOrganizationbundle:Region')
            ->findOneBySlug($slug);

        if (!$region) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching region found.'
                );
            $this->redirect($this->generateUrl('scss_region_index'));
        }

        return array('region' => $region);
    }

    /**
     * @Route("/new", name="scss_region_new")
     * @Template("SCSSOrganizationbundle:Region:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $region = new Region();
        $form = $this->createForm(new RegionType(), $region);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($region);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'region created.'
                );

                return $this->render(
                    'SCSSOrganizationbundle:Region:show.html.twig',
                    array(
                        'region' => $region
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
