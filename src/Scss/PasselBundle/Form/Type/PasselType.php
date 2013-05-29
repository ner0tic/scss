<?php
namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\PasselBundle\Entity\Passel;

class PasselType extends AbstractType 
{
    public function buildForm( FormBuilderInterface $builder, array $options ) 
    {
        $builder->add( 'name' );
        $builder->add( 'passel_type' );
        $builder->add( 'region' );
        $builder->add( 'photo', 'file' );
        $builder->add( 'logo', 'file' );
        $builder->add( 'passel_leader' );        
    }

    public function getName() {
        return 'passel';
    }
}