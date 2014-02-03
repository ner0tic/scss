<?php
namespace SCSS\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

use SCSS\PasselBundle\Entity\Attendee;
use SCSS\PasselBundle\Form\Type\AttendeeType;

class AttendeeController extends Controller
{
    /**
     * @Route("/", name="scss_attendee_index")
     * @Template("SCSSPasselBundle:Attendee:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSPasselBundle:Attendee')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'attendees' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_attendee_show")
     * @Template("SCSSPasselBundle:Attendee:show.html.twig")
     */
    public function showAction($slug)
    {
        $attendee = $this->getDoctrine()
            ->getRepository('SCSSPasselbundle:Attendee')
            ->findOneBySlug($slug);

        if (!$attendee) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching attendee found.'
                );
            $this->redirect($this->generateUrl('scss_attendee_index'));
        }

        return array('attendee' => $attendee);
    }


    /**
     * @Route("/new", name="scss_attendee_new")
     * @Template("SCSSPasselbundle:Attendee:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $attendee = new Attendee();
        $form = $this->createForm(new AttendeeType(), $attendee);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($attendee);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'attendee created.'
                );

                return $this->render(
                    'SCSSPasselbundle:Attendee:show.html.twig',
                    array(
                        'attendee' => $attendee
                   )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
