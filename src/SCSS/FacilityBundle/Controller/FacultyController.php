<?php
namespace SCSS\FacilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\FacilityBundle\Entity\Faculty;
use SCSS\FacilityBundle\Form\Type\FacultyType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class FacultyController extends Controller
{
    /**
     * @Route("/", name="scss_faculty_index")
     * @Template("SCSSFacilityBundle:Faculty:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSFacilityBundle:Faculty')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'facultys' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_faculty_show")
     * @Template("SCSSFacilityBundle:Faculty:show.html.twig")
     */
    public function showAction($slug)
    {
        $faculty = $this->getDoctrine()
            ->getRepository('SCSSFacilitybundle:Faculty')
            ->findOneBySlug($slug);

        if (!$faculty) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching faculty found.'
                );
            $this->redirect($this->generateUrl('scss_faculty_index'));
        }

        return array('faculty' => $faculty);
    }

    /**
     * @Route("/new", name="scss_faculty_new")
     * @Template("SCSSFacilitybundle:Faculty:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $faculty = new Faculty();
        $form = $this->createForm(new FacultyType(), $faculty);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($faculty);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'faculty created.'
                );

                return $this->render(
                    'SCSSFacilitybundle:Faculty:show.html.twig',
                    array(
                        'faculty' => $faculty
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
