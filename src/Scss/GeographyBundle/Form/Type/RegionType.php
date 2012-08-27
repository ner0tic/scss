<?php
namespace Scss\GeographyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\GeographyBundle\Entity\Region;

class RegionType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name', 'text');
    $builder->add('iso_code');
    $builder->add('organization');
    $builder->add('logo', 'file');
    $builder->add('photo', 'file');
    $builder->add('latitude');
    $builder->add('longitude');
  }
  
  public function getName() {
    return 'region';
  }
}