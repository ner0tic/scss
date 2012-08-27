<?php
namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\OrganizationBundle\Entity\GroupLeader;

class GroupLeaderType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('first_name');
    $builder->add('last_name');
    $builder->add('birthdate', 'birthday');
    $builder->add('group');
  }
  
  public function getName() {
    return 'group_leader';
  }
}