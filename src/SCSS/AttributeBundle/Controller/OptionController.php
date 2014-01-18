<?php

namespace SCSS\AttributeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\AttributeBundle\Entity\Option;
use SCSS\AttributeBundle\Form\Type\OptionType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class OptionController extends Controller
{
    /**
     * @Route("/", name="scss_option_index")
     * @Template("SCSSAttributeBundle:Option:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSAttributeBundle:Option')
            ->createQueryBuilder('a')
            ->orderBy('a.updated, a.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'options' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_option_show")
     * @Template("SCSSAttributeBundle:Option:show.html.twig")
     */
    public function showAction($slug)
    {
        $option = $this->getDoctrine()
            ->getRepository('SCSSAttributeBundle:Option')
            ->findOneBySlug($slug);

        if (!$option) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching option found.'
                );
            $this->redirect($this->generateUrl('scss_option_index'));
        }

        return array('option' => $option);
    }


    /**
     * @Route("/new", name="scss_option_new")
     * @Template("SCSSAttributeBundle:Option:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $option = new Option();
        $form = $this->createForm(new OptionType(), $option);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($option);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'option created.'
                );

                return $this->render(
                    'SCSSAttributeBundle:Option:show.html.twig',
                    array(
                        'option' => $option
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
