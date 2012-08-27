<?php
namespace Scss\FacilityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\FacilityBundle\Entity\GroupEnrollment;

class GroupEnrollmentType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('group');
    $builder->add('facility');
    $builder->add('week');
  }
  
  public function getName() {
    return 'group_enrollment';
  }
}