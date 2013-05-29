<?php
namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\PasselBundle\Entity\PasselType;

class PasselTypeType extends AbstractType 
{
    public function buildForm( FormBuilderInterface $builder, array $options ) 
    {
        $builder->add( 'name' );
        $builder->add( 'description' );
        $builder->add( 'iso_code' );
    }

    public function getName() {
        return 'passel_type';
    }
}