<?php

namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfilePasselLeaderTypeFormType extends BaseType
{
    public function buildForm( FormBuilder $builder, array $options )
    {
        parent::buildForm( $builder, $options );
    }
}