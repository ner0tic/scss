<?php

namespace Scss\FacilityBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFacultyTypeFormType extends BaseType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        parent::buildForm( $builder, $options );
    }
}