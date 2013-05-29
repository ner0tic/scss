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
    Scss\PasselBundle\Entity\Passel,
    Scss\PasselBundle\Form\Type\PasselType;

class PasselController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $passels = $this->get( 'doctrine' )
                          ->getRepository( 'ScssPasselBundle:Passel' );
        
        if ( !$passels) {
          throw $this->createNotFoundException( 'No passels found.' );
        }
        
        return $this->render( 'ScssPasselBundle:Passel:index.html.twig', array('passels' => $passels ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $passel = $this->getDoctrine()
                       ->getRepository( 'ScssPasselBundle:Passel' )
                       ->findBySlug( $slug );
      
      if( !$passel )
      {
        throw $this->createNotFoundException( 'No passel found.' );
      }
      
      return $this->render( 'ScssPasselBundle:Passel:show.html.twig', array('passel' => $passel ) );
    }
 
    public function newAction( Request $request ) 
    {
        $passel = new Passel();
        $form = $this->createForm( new PasselType(), $passel );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $passel );
                $em->flush();

              return $this->render( 'ScssPasselBundle:Passel:show.html.twig', array(
                  'passel_slug' => $passel->getSlug()
              ));
            }
        }

        return $this->render( 'ScssPasselBundle:Passel:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
