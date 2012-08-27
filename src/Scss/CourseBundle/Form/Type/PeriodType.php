<?php
namespace Scss\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\CourseBundle\Entity\Period;

class PeriodType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('special');
    $builder->add('week');
    $builder->add('start', 'time');
    $builder->add('end', 'time');
  }
  
  public function getName() {
    return 'period';
  }
}