<?php

namespace SCSS\FacilityBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFacultyFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        // add your custom field
        $builder->add('quarters',
                      'entity',
                      array(
                        'property'  =>  'name',
                        'class'     => 'SCSS\FacilityBundle\Entity\Quarters',
                        'required'  => false
        ) );
    }

    public function getName()
    {
        return 'SCSS_faculty_registration_form';
    }
}
