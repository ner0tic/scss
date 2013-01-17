<?php
namespace Scss\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class RegistrationAttendee extends BaseController
{
    public function registerAction()
    {
        $handler = $this->container->get( 'pugx_multi_user.controller.handler' );
        $discriminator = $this->container->get( 'pugx_user_discriminator' );

        $return = $handler->registration( 'Scss\OrganizationBundle\Entity\Attendee' );
        $form = $discriminator->getRegistrationForm();

        if( $return instanceof RedirectResponse ) 
        {
            return $return;
        }

        /** @todo fix this! */
        if( 'POST' === $request->getMethod() ) 
        {
            $form->bind( $request );
        }
        
        return $this->container
                    ->get( 'templating' )
                    ->renderResponse( 'ScssOrganizationBundle:Registration:attendee.form.html.twig', 
                            array(
                                'form' => $form->createView(),
                    ) );
    }
}