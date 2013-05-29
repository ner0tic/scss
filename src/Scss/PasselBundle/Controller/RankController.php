<?php
    namespace Scss\PasselBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Request,
    Geocoder\Geocoder,
    Geocoder\HttpAdapter\CurlHttpAdapter,
    Geocoder\Provider\ChainProvider,
    Geocoder\Provider\GoogleMapsProvider,
    Geocoder\Provider\FreeGeoIpProvider,
    GeoPoint\Api\GeoPointApi as GP,
    Scss\PasselBundle\Entity\Rank,
    Scss\PasselBundle\Form\Type\RankType;

class RankController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $ranks = $this->get( 'doctrine' )
                          ->getRepository( 'ScssPasselBundle:Rank' );
        
        if ( !$ranks) {
          throw $this->createNotFoundException( 'No ranks found.' );
        }
        
        return $this->render( 'ScssPasselBundle:Rank:index.html.twig', array('ranks' => $ranks ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $rank = $this->getDoctrine()
                       ->getRepository( 'ScssPasselBundle:Rank' )
                       ->findBySlug( $slug );
      
      if( !$rank )
      {
        throw $this->createNotFoundException( 'No rank found.' );
      }
      
      return $this->render( 'ScssPasselBundle:Rank:show.html.twig', array('rank' => $rank ) );
    }
 
    public function newAction( Request $request ) 
    {
        $rank = new Rank();
        $form = $this->createForm( new RankType(), $rank );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $rank );
                $em->flush();

              return $this->render( 'ScssPasselBundle:Rank:show.html.twig', array(
                  'rank_slug' => $rank->getSlug()
              ));
            }
        }

        return $this->render( 'ScssPasselBundle:Rank:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
