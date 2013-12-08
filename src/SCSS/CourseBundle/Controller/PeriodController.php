<?php
namespace SCSS\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\CourseBundle\Entity\Period;
use SCSS\CourseBundle\Form\Type\PeriodType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class PeriodController extends Controller
{
    /**
     * @Route("/", name="scss_period_index")
     * @Template("SCSSCourseBundle:Period:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSCourseBundle:Period')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'periods' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_period_show")
     * @Template("SCSSCourseBundle:Period:show.html.twig")
     */
    public function showAction($slug)
    {
        $period = $this->getDoctrine()
            ->getRepository('SCSSCoursebundle:Period')
            ->findOneBySlug($slug);

        if (!$period) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching period found.'
                );
            $this->redirect($this->generateUrl('scss_period_index'));
        }

        return array('period' => $period);
    }

    /**
     * @Route("/new", name="scss_period_new")
     * @Template("SCSSCoursebundle:Period:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $period = new Period();
        $form = $this->createForm(new PeriodType(), $period);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($period);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'period created.'
                );

                return $this->render(
                    'SCSSCoursebundle:Period:show.html.twig',
                    array(
                        'period' => $period
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
