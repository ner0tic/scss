<?php
namespace SCSS\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\CourseBundle\Entity\Requirement;
use SCSS\CourseBundle\Form\Type\RequirementType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class RequirementController extends Controller
{
    /**
     * @Route("/", name="scss_requirement_index")
     * @Template("SCSSCourseBundle:Requirement:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSCourseBundle:Requirement')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'requirements' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_requirement_show")
     * @Template("SCSSCourseBundle:Requirement:show.html.twig")
     */
    public function showAction($slug)
    {
        $requirement = $this->getDoctrine()
            ->getRepository('SCSSCoursebundle:Requirement')
            ->findOneBySlug($slug);

        if (!$requirement) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching requirement found.'
                );
            $this->redirect($this->generateUrl('scss_requirement_index'));
        }

        return array('requirement' => $requirement);
    }

    /**
     * @Route("/new", name="scss_requirement_new")
     * @Template("SCSSCoursebundle:Requirement:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $requirement = new Requirement();
        $form = $this->createForm(new RequirementType(), $requirement);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($requirement);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'requirement created.'
                );

                return $this->render(
                    'SCSSCoursebundle:Requirement:show.html.twig',
                    array(
                        'requirement' => $requirement
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
