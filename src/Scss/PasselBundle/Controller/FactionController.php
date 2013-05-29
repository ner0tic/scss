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
    Scss\PasselBundle\Entity\Faction,
    Scss\PasselBundle\Form\Type\FactionType;

class FactionController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $factions = $this->get( 'doctrine' )
                          ->getRepository( 'ScssPasselBundle:Faction' );
        
        if ( !$factions) {
          throw $this->createNotFoundException( 'No factions found.' );
        }
        
        return $this->render( 'ScssPasselBundle:Faction:index.html.twig', array('factions' => $factions ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $faction = $this->getDoctrine()
                       ->getRepository( 'ScssPasselBundle:Faction' )
                       ->findBySlug( $slug );
      
      if( !$faction )
      {
        throw $this->createNotFoundException( 'No faction found.' );
      }
      
      return $this->render( 'ScssPasselBundle:Faction:show.html.twig', array('faction' => $faction ) );
    }
 
    public function newAction( Request $request ) 
    {
        $faction = new Faction();
        $form = $this->createForm( new FactionType(), $faction );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $faction );
                $em->flush();

              return $this->render( 'ScssPasselBundle:Faction:show.html.twig', array(
                  'faction_slug' => $faction->getSlug()
              ));
            }
        }

        return $this->render( 'ScssPasselBundle:Faction:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
