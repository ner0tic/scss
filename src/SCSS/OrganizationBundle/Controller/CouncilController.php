<?php
namespace SCSS\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\OrganizationBundle\Entity\Council;
use SCSS\OrganizationBundle\Form\Type\CouncilType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class CouncilController extends Controller
{
    /**
     * @Route("/", name="scss_council_index")
     * @Template("SCSSOrganizationBundle:Council:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSOrganizationBundle:Council')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'councils' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_council_show")
     * @Template("SCSSOrganizationBundle:Council:show.html.twig")
     */
    public function showAction($slug)
    {
        $council = $this->getDoctrine()
            ->getRepository('SCSSOrganizationbundle:Council')
            ->findOneBySlug($slug);

        if (!$council) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching council found.'
                );
            $this->redirect($this->generateUrl('scss_council_index'));
        }

        return array('council' => $council);
    }

    /**
     * @Route("/new", name="scss_council_new")
     * @Template("SCSSOrganizationbundle:Council:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $council = new Council();
        $form = $this->createForm(new CouncilType(), $council);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($council);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'council created.'
                );

                return $this->render(
                    'SCSSOrganizationbundle:Council:show.html.twig',
                    array(
                        'council' => $council
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
