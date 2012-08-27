<?php
namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\OrganizationBundle\Entity\GroupType;

class GroupTypeType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('description');
    $builder->add('iso_code');
  }
  
  public function getName() {
    return 'group_type';
  }
}