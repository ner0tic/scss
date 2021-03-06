<?php
namespace SCSS\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\CourseBundle\Entity\FacilityCourse;
use SCSS\CourseBundle\Form\Type\FacilityCourseType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class FacilityCourseController extends Controller
{
    /**
     * @Route("/", name="scss_facility_course_index")
     * @Template("SCSSCourseBundle:FacilityCourse:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSCourseBundle:FacilityCourse')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'facility_courses' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_facility_course_show")
     * @Template("SCSSCourseBundle:FacilityCourse:show.html.twig")
     */
    public function showAction($slug)
    {
        $facility_course = $this->getDoctrine()
            ->getRepository('SCSSCoursebundle:FacilityCourse')
            ->findOneBySlug($slug);

        if (!$facility_course) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching facility_course found.'
                );
            $this->redirect($this->generateUrl('scss_facility_course_index'));
        }

        return array('facility_course' => $facility_course);
    }

    /**
     * @Route("/new", name="scss_facility_course_new")
     * @Template("SCSSCoursebundle:FacilityCourse:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $facility_course = new FacilityCourse();
        $form = $this->createForm(new FacilityCourseType(), $facility_course);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($facility_course);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'facility course created.'
                );

                return $this->render(
                    'SCSSCoursebundle:FacilityCourse:show.html.twig',
                    array(
                        'facility_course' => $facility_course
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
