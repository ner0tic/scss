<?php
namespace SCSS\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\PasselBundle\Entity\Passel;
use SCSS\PasselBundle\Form\Type\PasselType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class PasselController extends Controller
{
    /**
     * @Route("/", name="scss_passel_index")
     * @Template("SCSSPasselBundle:Passel:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSPasselBundle:Passel')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'passels' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_passel_show")
     * @Template("SCSSPasselBundle:Passel:show.html.twig")
     */
    public function showAction( $slug )
    {
        $passel = $this->getDoctrine()
            ->getRepository('SCSSPasselbundle:Passel')
            ->findOneBySlug($slug);

        if (!$passel) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching passel found.'
                );
            $this->redirect($this->generateUrl('scss_passel_index'));
        }

        return array('passel' => $passel);
    }


    /**
     * @Route("/new", name="scss_passel_new")
     * @Template("SCSSPasselbundle:Passel:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $passel = new Passel();
        $form = $this->createForm(new PasselType(), $passel);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($passel);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'passel created.'
                );

                return $this->render(
                    'SCSSPasselbundle:Passel:show.html.twig',
                    array(
                        'passel' => $passel
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
