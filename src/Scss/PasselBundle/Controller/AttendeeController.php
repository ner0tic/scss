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
    Scss\PasselBundle\Entity\Attendee,
    Scss\PasselBundle\Form\Type\AttendeeType;

class AttendeeController extends Controller
{
    /**
     * 
     * @return render
     * @throws NotFoundException
     */
    public function indexAction()
    {
        // get route name/params to decypher data to delimit by
        $attendees = $this->get( 'doctrine' )
                          ->getRepository( 'ScssPasselBundle:Attendee' );
        
        if ( !$attendees) {
          throw $this->createNotFoundException( 'No attendees found.' );
        }
        
        return $this->render( 'ScssPasselBundle:Attendee:index.html.twig', array('attendees' => $attendees ) );
    }
    
    /**
     * 
     * @param string $slug
     * @return return
     * @throws NotFoundException
     */
    public function showAction( $slug )
    {
      $attendee = $this->getDoctrine()
                       ->getRepository( 'ScssPasselBundle:Attendee' )
                       ->findBySlug( $slug );
      
      if( !$attendee )
      {
        throw $this->createNotFoundException( 'No attendee found.' );
      }
      
      return $this->render( 'ScssPasselBundle:Attendee:show.html.twig', array('attendee' => $attendee ) );
    }
 
    public function newAction( Request $request ) 
    {
        $attendee = new Attendee();
        $form = $this->createForm( new AttendeeType(), $attendee );

        if ( $request->getMethod() == 'POST' ) 
        {
            $form->bindRequest( $this->getRequest() );
            if( $form->isValid() ) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist( $attendee );
                $em->flush();

              return $this->render( 'ScssPasselBundle:Attendee:show.html.twig', array(
                  'attendee_slug' => $attendee->getSlug()
              ));
            }
        }

        return $this->render( 'ScssPasselBundle:Attendee:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
