<?php

namespace SCSS\AttributeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\AttributeBundle\Entity\Value;
use SCSS\AttributeBundle\Form\Type\ValueType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class ValueController extends Controller
{
    /**
     * @Route("/", name="scss_value_index")
     * @Template("SCSSAttributeBundle:Value:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSAttributeBundle:Value')
            ->createQueryBuilder('a')
            ->orderBy('a.updated, a.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'values' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_value_show")
     * @Template("SCSSAttributeBundle:Value:show.html.twig")
     */
    public function showAction($slug)
    {
        $value = $this->getDoctrine()
            ->getRepository('SCSSAttributeBundle:Value')
            ->findOneBySlug($slug);

        if (!$value) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching value found.'
                );
            $this->redirect($this->generateUrl('scss_value_index'));
        }

        return array('value' => $value);
    }


    /**
     * @Route("/new", name="scss_value_new")
     * @Template("SCSSAttributeBundle:Value:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $value = new Value();
        $form = $this->createForm(new ValueType(), $value);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($value);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'value created.'
                );

                return $this->render(
                    'SCSSAttributeBundle:Value:show.html.twig',
                    array(
                        'value' => $value
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
