<?php
namespace SCSS\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SCSS\OrganizationBundle\Entity\Organization;

class OrganizationType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->add( 'name' );
        $builder->add( 'code' );
        $builder->add( 'zone' );
        $builder->add( 'country' );
    }

    public function getName() {
        return 'organization';
    }
}
