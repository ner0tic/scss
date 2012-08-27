<?php
namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\OrganizationBundle\Entity\ScssGroup;

class ScssGroupType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('group_type');
    $builder->add('region');
    $builder->add('photo', 'file');
    $builder->add('logo', 'file');
    $builder->add('leader');        
  }
  
  public function getName() {
    return 'scss_group';
  }
}