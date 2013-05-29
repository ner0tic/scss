<?php

namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationPasselLeaderFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        // add your custom field
        $builder->add('passel',  
                      'entity',   
                      array( 
                        'property'  =>  'name', 
                        'class'     => 'Scss\PasselBundle\Entity\Passel'
        ) );
    }

    public function getName()
    {
        return 'scss_passel_leader_registration';
    }
}