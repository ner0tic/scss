<?php

namespace Scss\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class SignupFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );
        
    }

    public function getName()
    {
        return 'scss_user_signup';
    }
}