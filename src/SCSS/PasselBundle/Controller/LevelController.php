<?php
namespace SCSS\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\PasselBundle\Entity\Level;
use SCSS\PasselBundle\Form\Type\LevelType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class LevelController extends Controller
{
    /**
     * @Route("/", name="scss_level_index")
     * @Template("SCSSPasselBundle:Level:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSPasselBundle:Level')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'levels' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_level_show")
     * @Template("SCSSPasselBundle:Level:show.html.twig")
     */
    public function showAction( $slug )
    {
        $level = $this->getDoctrine()
            ->getRepository('SCSSPasselbundle:Level')
            ->findOneBySlug($slug);

        if (!$level) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching level found.'
                );
            $this->redirect($this->generateUrl('scss_level_index'));
        }

        return array('level' => $level);
    }


    /**
     * @Route("/new", name="scss_level_new")
     * @Template("SCSSPasselbundle:Level:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $level = new Level();
        $form = $this->createForm(new LevelType(), $level);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($level);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'level created.'
                );

                return $this->render(
                    'SCSSPasselbundle:Level:show.html.twig',
                    array(
                        'level' => $level
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
