<?php
namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\OrganizationBundle\Entity\SubGroup;

class SubGroupType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('photo', 'file');
    $builder->add('logo', 'file');
    $builder->add('group');
    
  }
  
  public function getName() {
    return 'sub_group';
  }
}