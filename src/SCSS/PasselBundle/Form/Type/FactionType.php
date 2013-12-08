<?php
namespace SCSS\PasselBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SCSS\PasselBundle\Entity\Faction;

class FactionType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder->add( 'name' );
        $builder->add( 'photo', 'file' );
        $builder->add( 'logo', 'file' );
        $builder->add( 'passel' );
    }

    public function getName() {
        return 'faction';
    }
}
