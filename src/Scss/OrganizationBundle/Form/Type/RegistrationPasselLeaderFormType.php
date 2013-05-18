<?php

namespace Scss\FacilityBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationPasselLeaderTypeFormType extends BaseType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        // add your custom field
        $builder->add('passel',  
                      'entity',   
                      array( 
                        'property'  =>  'name', 
                        'class'     => 'Scss\OrganizationBundle\Entity\Passel'
        ) );
    }

    public function getName()
    {
        return 'scss_passel_leader_registration';
    }
}