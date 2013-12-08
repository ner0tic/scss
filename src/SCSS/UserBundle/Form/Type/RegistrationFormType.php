<?php
namespace SCSS\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm($builder, $options);

        $builder->add( 'type' );
//        $builder->add( 'terms', 'checkbox', array(
//            'property_path' =>  'termsAccepted'
//        ));
    }

    public function getName()
    {
        return 'SCSS_user_registration';
    }
}
