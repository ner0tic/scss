<?php
namespace SCSS\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\PasselBundle\Entity\Leader;
use SCSS\PasselBundle\Form\Type\LeaderType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class LeaderController extends Controller
{
    /**
     * @Route("/", name="scss_leader_index")
     * @Template("SCSSPasselBundle:Leader:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSPasselBundle:Leader')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'leaders' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_leader_show")
     * @Template("SCSSPasselBundle:Leader:show.html.twig")
     */
    public function showAction( $slug )
    {
        $leader = $this->getDoctrine()
            ->getRepository('SCSSPasselbundle:Leader')
            ->findOneBySlug($slug);

        if (!$leader) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching leader found.'
                );
            $this->redirect($this->generateUrl('scss_leader_index'));
        }

        return array('leader' => $leader);
    }


    /**
     * @Route("/new", name="scss_leader_new")
     * @Template("SCSSPasselbundle:Leader:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $leader = new Leader();
        $form = $this->createForm(new LeaderType(), $leader);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($leader);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'leader created.'
                );

                return $this->render(
                    'SCSSPasselbundle:Leader:show.html.twig',
                    array(
                        'leader' => $leader
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
