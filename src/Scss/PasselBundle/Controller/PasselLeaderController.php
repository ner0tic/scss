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
    Scss\PasselBundle\Entity\PasselLeader,
    Scss\PasselBundle\Form\Type\PasselLeaderType;

class PasselLeaderController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $passel_leaders = $this->get( 'doctrine' )
                          ->getRepository( 'ScssPasselBundle:PasselLeader' );
        
        if ( !$passel_leaders) {
          throw $this->createNotFoundException( 'No passel leaders found.' );
        }
        
        return $this->render( 'ScssPasselBundle:PasselLeader:index.html.twig', array('passel_leaders' => $passel_leaders ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $passel_leader = $this->getDoctrine()
                       ->getRepository( 'ScssPasselBundle:PasselLeader' )
                       ->findBySlug( $slug );
      
      if( !$passel_leader )
      {
        throw $this->createNotFoundException( 'No passel found.' );
      }
      
      return $this->render( 'ScssPasselBundle:PasselLeader:show.html.twig', array('passel_leader' => $passel_leader ) );
    }
 
    public function newAction( Request $request ) 
    {
        $passel_leader = new PasselLeader();
        $form = $this->createForm( new PasselLeaderType(), $passel_leader );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $passel_leader );
                $em->flush();

              return $this->render( 'ScssPasselBundle:PasselLeader:show.html.twig', array(
                  'passel_leader_slug' => $passel_leader->getSlug()
              ));
            }
        }

        return $this->render( 'ScssPasselBundle:PasselLeader:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
