<?php
namespace SCSS\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use SCSS\PasselBundle\Entity\Faction;
use SCSS\PasselBundle\Form\Type\FactionType;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\View\TwitterBootstrapView;

class FactionController extends Controller
{
    /**
     * @Route("/", name="scss_faction_index")
     * @Template("SCSSPasselBundle:Faction:index.html.twig")
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $query = $this->get('doctrine')
            ->getRepository('SCSSPasselBundle:Faction')
            ->createQueryBuilder('l')
            ->orderBy('l.updated, l.name', 'ASC');

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager->setMaxPerPage($this->getRequest()->get('pageMax', 5));
        $pager->setCurrentPage($this->getRequest()->get('page', 1));

        return array(
          'factions' => $pager->getCurrentPageResults(),
          'pager'  => $pager
        );
    }

    /**
     * @Route("/{slug}", name="scss_faction_show")
     * @Template("SCSSPasselBundle:Faction:show.html.twig")
     */
    public function showAction( $slug )
    {
        $faction = $this->getDoctrine()
            ->getRepository('SCSSPasselbundle:Faction')
            ->findOneBySlug($slug);

        if (!$faction) {
            $this->get('session')
                ->getFlashBag()->add(
                    'error',
                    'no matching faction found.'
                );
            $this->redirect($this->generateUrl('scss_faction_index'));
        }

        return array('faction' => $faction);
    }


    /**
     * @Route("/new", name="scss_faction_new")
     * @Template("SCSSPasselbundle:Faction:new.html.twig")
     */
    public function newAction(Request $request)
    {
        $faction = new Faction();
        $form = $this->createForm(new FactionType(), $faction);

        if ("POST" == $request->getMethod()) {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($faction);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'success',
                    'faction created.'
                );

                return $this->render(
                    'SCSSPasselbundle:Faction:show.html.twig',
                    array(
                        'faction' => $faction
                    )
                );
            }
        }

        return array('form' => $form->createView());
    }
}
