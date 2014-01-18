<?php

namespace SCSS\AttributeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\AttributeBundle\Entity\Attribute;
use SCSS\AttributeBundle\Form\Type\AttributeType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class AttributeController extends Controller
{
    /**
     * @Route("/", name="scss_attribute_index")
     * @Template("SCSSAttributeBundle:Attribute:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSAttributeBundle:Attribute')
            ->createQueryBuilder('a')
            ->orderBy('a.updated, a.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'attributes' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_attribute_show")
     * @Template("SCSSAttributeBundle:Attribute:show.html.twig")
     */
    public function showAction($slug)
    {
        $attribute = $this->getDoctrine()
            ->getRepository('SCSSAttributeBundle:Attribute')
            ->findOneBySlug($slug);

        if (!$attribute) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching attribute found.'
                );
            $this->redirect($this->generateUrl('scss_attribute_index'));
        }

        return array('attribute' => $attribute);
    }


    /**
     * @Route("/new", name="scss_attribute_new")
     * @Template("SCSSAttributeBundle:Attribute:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $attribute = new Attribute();
        $form = $this->createForm(new AttributeType(), $attribute);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($attribute);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'attribute created.'
                );

                return $this->render(
                    'SCSSAttributeBundle:Attribute:show.html.twig',
                    array(
                        'attribute' => $attribute
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
