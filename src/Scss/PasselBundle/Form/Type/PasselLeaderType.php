<?php
namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\PasselBundle\Entity\PasselLeader;

class PasselLeaderType extends AbstractType 
{
    public function buildForm( FormBuilderInterface $builder, array $options ) 
    {
        $builder->add( 'first_name' );
        $builder->add( 'last_name' );
        $builder->add( 'birthdate', 'birthday' );
        $builder->add( 'passel' );
    }

    public function getName() {
        return 'passel_leader';
    }
}