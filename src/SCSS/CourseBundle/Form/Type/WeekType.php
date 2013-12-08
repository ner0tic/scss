<?php
namespace SCSS\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SCSS\CourseBundle\Entity\Week;

class WeekType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('start', 'date');
    $builder->add('end', 'date');
    $builder->add('special');
    $builder->add('facility');
  }

  public function getName() {
    return 'week';
  }
}
