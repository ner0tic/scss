<?php
namespace Scss\FacilityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\FacilityBundle\Entity\Facility;

class FacilityType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('phone');
    $builder->add('fax');
    $builder->add('url', 'url');
    $builder->add('email', 'email');
    $builder->add('faculty');
    $builder->add('quarters');
    $builder->add('region');
    $builder->add('departments');
  }
  
  public function getName() {
    return 'facility';
  }
}