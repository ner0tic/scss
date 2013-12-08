<?php
namespace SCSS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class RegistrationFaculty extends BaseController
{
    public function registerAction()
    {
        $handler = $this->container->get( 'pugx_multi_user.controller.handler' );
        $discriminator = $this->container->get( 'pugx_user_discriminator' );

        $return = $handler->registration( 'SCSS\FacilityBundle\Entity\Faculty' );
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
                    ->renderResponse( 'SCSSFacilityBundle:Registration:attendee.form.html.twig',
                            array(
                                'form' => $form->createView(),
                    ) );
    }
}
