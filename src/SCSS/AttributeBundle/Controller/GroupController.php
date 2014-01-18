<?php

namespace SCSS\AttributeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\AttributeBundle\Entity\Group;
use SCSS\AttributeBundle\Form\Type\GroupType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class GroupController extends Controller
{
    /**
     * @Route("/", name="scss_group_index")
     * @Template("SCSSAttributeBundle:Group:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSAttributeBundle:Group')
            ->createQueryBuilder('a')
            ->orderBy('a.updated, a.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'groups' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_group_show")
     * @Template("SCSSAttributeBundle:Group:show.html.twig")
     */
    public function showAction($slug)
    {
        $group = $this->getDoctrine()
            ->getRepository('SCSSAttributeBundle:Group')
            ->findOneBySlug($slug);

        if (!$group) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching group found.'
                );
            $this->redirect($this->generateUrl('scss_group_index'));
        }

        return array('group' => $group);
    }


    /**
     * @Route("/new", name="scss_group_new")
     * @Template("SCSSAttributeBundle:Group:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $group = new Group();
        $form = $this->createForm(new GroupType(), $group);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($group);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'group created.'
                );

                return $this->render(
                    'SCSSAttributeBundle:Group:show.html.twig',
                    array(
                        'group' => $group
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
