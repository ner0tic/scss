<?php
namespace SCSS\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\FacilityBundle\Entity\Facility;
use SCSS\FacilityBundle\Form\Type\FacilityType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class FacilityController extends Controller
{
    /**
     * @Route("/", name="scss_facility_index")
     * @Template("SCSSFacilityBundle:Facility:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSFacilityBundle:Facility')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'facilitys' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_facility_show")
     * @Template("SCSSFacilityBundle:Facility:show.html.twig")
     */
    public function showAction($slug)
    {
        $facility = $this->getDoctrine()
            ->getRepository('SCSSFacilitybundle:Facility')
            ->findOneBySlug($slug);

        if (!$facility) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching facility found.'
                );
            $this->redirect($this->generateUrl('scss_facility_index'));
        }

        return array('facility' => $facility);
    }

    /**
     * @Route("/new", name="scss_facility_new")
     * @Template("SCSSFacilitybundle:Facility:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $facility = new Facility();
        $form = $this->createForm(new FacilityType(), $facility);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($facility);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'facility created.'
                );

                return $this->render(
                    'SCSSFacilitybundle:Facility:show.html.twig',
                    array(
                        'facility' => $facility
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
