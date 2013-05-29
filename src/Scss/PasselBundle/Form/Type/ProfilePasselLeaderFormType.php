<?php

namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfilePasselLeaderFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );
    }
}